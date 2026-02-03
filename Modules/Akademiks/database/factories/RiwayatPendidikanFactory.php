<?php

namespace Modules\Akademiks\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\RiwayatPendidikan;

class RiwayatPendidikanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = RiwayatPendidikan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nim' => $this->faker->unique()->numerify('##########'),
            'id_prodi' => $this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika']),
            'id_periode_masuk' => $this->faker->year . '1',
            'id_status_mahasiswa' => $this->faker->randomElement(['A', 'C', 'N']), // A: Aktif, C: Cuti, N: Non-Aktif
            'id_jenis_daftar' => '1',
            'id_jalur_daftar' => '1',
            'tanggal_masuk' => $this->faker->date,
            'id_pembiayaan' => '1',
            'id_perguruan_tinggi' => 'Universitas Contoh',
            'biaya_awal' => '0',
            'id_server' => $this->faker->uuid,
        ];
    }
}
