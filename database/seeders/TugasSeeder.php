<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\Tugas;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $mkIds = MataKuliah::pluck('id')->all();
        $jenis = ['Kuis', 'Laporan', 'Presentasi', 'Latihan Soal', 'Proyek', 'Belajar kelompok'];

        for ($i = 0; $i < 15; $i++) {
            Tugas::create([
                'mata_kuliah_id' => $faker->randomElement($mkIds),
                'judul'          => $faker->randomElement($jenis) . ' ' . $faker->numberBetween(1, 5),
                'tanggal'        => $faker->dateTimeBetween('first day of this month', 'last day of this month')->format('Y-m-d'),
                'waktu'          => $faker->time('H:i'),
                'prioritas'      => $faker->randomElement(['Tinggi', 'Sedang', 'Rendah']),
                'catatan'        => $faker->sentence(8),
            ]);
        }
    }
}