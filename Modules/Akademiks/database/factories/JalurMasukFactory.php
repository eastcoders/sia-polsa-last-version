<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\JalurMasuk;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\JalurMasuk>
 */
class JalurMasukFactory extends Factory
{
    protected $model = JalurMasuk::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jalur_masuk' => $this->faker->randomElement(['SNMPTN', 'SBMPTN', 'Mandiri', 'Prestasi']),
        ];
    }
}
