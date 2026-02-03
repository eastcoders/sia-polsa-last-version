<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\Semester;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\Semester>
 */
class SemesterFactory extends Factory
{
    protected $model = Semester::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->year();
        $sem = $this->faker->randomElement(['1', '2']);
        return [
            'id_semester' => $year . $sem,
            'id_tahun_ajaran' => $year,
            'nama_semester' => $year . '/' . ($year + 1) . ' ' . ($sem == '1' ? 'Ganjil' : 'Genap'),
            'a_periode_aktif' => '1',
        ];
    }
}
