<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $daftar = [
            ['MK001', 'Kalkulus'],
            ['MK002', 'Fisika Dasar'],
            ['MK003', 'Pemrograman Web'],
            ['MK004', 'Basis Data'],
            ['MK005', 'Algoritma dan Struktur Data'],
            ['MK006', 'Jaringan Komputer'],
        ];

        foreach ($daftar as [$kode, $nama]) {
            MataKuliah::create([
                'kode'  => $kode,
                'nama'  => $nama,
                'dosen' => $faker->name,
            ]);
        }
    }
}