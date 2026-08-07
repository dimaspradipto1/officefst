<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('surats', 'slug')) {
            Schema::table('surats', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique()->after('id');
            });
        }

        // Generate slug for existing rows
        $surats = DB::table('surats')->whereNull('slug')->orWhere('slug', '')->get();
        foreach ($surats as $s) {
            $base = Str::slug(($s->jenis_surat ?? 'surat') . '-' . ($s->kodepro ?? $s->id));
            $slug = $base . '-' . Str::lower(Str::random(6));
            
            // Ensure unique
            while (DB::table('surats')->where('slug', $slug)->where('id', '!=', $s->id)->exists()) {
                $slug = $base . '-' . Str::lower(Str::random(6));
            }

            DB::table('surats')->where('id', $s->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('surats', 'slug')) {
            Schema::table('surats', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};
