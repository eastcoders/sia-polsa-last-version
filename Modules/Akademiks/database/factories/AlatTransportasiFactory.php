<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\AlatTransportasi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\AlatTransportasi>
 */
class AlatTransportasiFactory extends Factory
{
    protected $model = AlatTransportasi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_alat_transportasi' => $this->faker->randomElement(['Jalan Kaki', 'Angkutan Umum', 'Kendaraan Pribadi', 'Ojek']),
        ];
    }
}
