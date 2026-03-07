<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'      => 'super admin',
                'email'     => 'superadmin@gmail.com',
                'password'  => Hash::make('superadmin'),
                'npm'       => '-',
                'prodi'     => '-',
                'nohp'      => '-',
                'role'      => 'superadmin',
                'is_aktive' => true,
            ],
            [
                'name'      => 'admin',
                'email'     => 'admin@uis.ac.id',
                'password'  => Hash::make('admin'),
                'npm'       => '-',
                'prodi'     => '-',
                'nohp'      => '-',
                'role'      => 'admin',
                'is_aktive' => true,
            ],
            [
                'name'      => 'ansar',
                'email'     => 'ansar@uis.ac.id',
                'password'  => Hash::make('ansar'),
                'npm'       => '-',
                'prodi'     => '-',
                'nohp'      => '-',
                'role'      => 'admin',
                'is_aktive' => true,
            ]
        ];

        foreach ($users as $item) {
            User::updateOrCreate(['email' => $item['email']], $item);
        }
    }
}
