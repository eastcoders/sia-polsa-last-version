<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\JenjangPendidikan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\JenjangPendidikan>
 */
class JenjangPendidikanFactory extends Factory
{
    protected $model = JenjangPendidikan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jenjang_didik' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
        ];
    }
}
