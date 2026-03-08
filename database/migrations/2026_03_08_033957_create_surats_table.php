<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('no_unik')->nullable();
            $table->string('name')->nullable();
            $table->string('prodi')->nullable();
            $table->string('no_surat')->nullable();
            $table->string('kodepro');
            $table->string('tujuan');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('nohp_perusahaan');
            $table->string('status')->default('proses');
            $table->string('judul_penelitian')->nullable();
            $table->string('jenis_surat');
            $table->date('tgl_disetujui')->nullable();
            $table->dateTime('tgl_estimasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
