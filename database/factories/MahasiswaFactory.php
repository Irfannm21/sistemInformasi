<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
  protected $model = Mahasiswa::class;

  public function definition()
  {
    return [
        'nim'        => $this->faker->unique()->numerify('10######'),
        'nama'       => $this->faker->firstName." ".$this->faker->lastName,
        'jurusan_id' => $this->faker->numberBetween(1,
                        \App\Models\Jurusan::count()),
    ];
  }
}
