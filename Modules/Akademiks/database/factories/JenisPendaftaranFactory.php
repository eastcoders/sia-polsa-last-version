<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\JenisPendaftaran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\JenisPendaftaran>
 */
class JenisPendaftaranFactory extends Factory
{
    protected $model = JenisPendaftaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jenis_pendaftaran' => $this->faker->randomElement(['Peserta Didik Baru', 'Pindahan', 'Alih Jenjang']),
        ];
    }
}
