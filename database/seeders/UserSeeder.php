<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator SIMPEL',
                'email' => 'admin@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567801',
                'active' => true,
            ],
            [
                'name' => 'Kepala BPVP Kendari',
                'email' => 'pimpinan@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'pimpinan',
                'phone' => '081234567802',
                'active' => true,
            ],
            [
                'name' => 'Tim Pemberdayaan Peserta',
                'email' => 'pemberdayaan@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'pemberdayaan',
                'phone' => '081234567803',
                'active' => true,
            ],
            [
                'name' => 'Koordinator Penyelenggara',
                'email' => 'penyelenggara@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'penyelenggara',
                'phone' => '081234567804',
                'active' => true,
            ],
            [
                'name' => 'Instruktur & Konsultan Produktivitas',
                'email' => 'produktivitas@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'produktivitas',
                'phone' => '081234567805',
                'active' => true,
            ],
            [
                'name' => 'LSP BPVP Kendari',
                'email' => 'lsp@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'lsp',
                'phone' => '081234567806',
                'active' => true,
            ],
            [
                'name' => 'Pejabat Pengadaan Barang & Jasa',
                'email' => 'pengadaan@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'pengadaan',
                'phone' => '081234567807',
                'active' => true,
            ],
            [
                'name' => 'Subbag Tata Usaha & Umum',
                'email' => 'umum@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'umum',
                'phone' => '081234567808',
                'active' => true,
            ],
            [
                'name' => 'Bendahara & Verifikator Keuangan',
                'email' => 'keuangan@bpvpkendari.go.id',
                'password' => Hash::make('password'),
                'role' => 'keuangan',
                'phone' => '081234567809',
                'active' => true,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
