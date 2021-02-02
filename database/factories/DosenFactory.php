<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
  protected $model = Dosen::class;

  public function definition()
  {
    $daftar_titel = ["M.Kom", "M.Sc", "M.T", "M.Si"];

    return [
        'nid'  => $this->faker->unique()->numerify('99######'),
        'nama' => $this->faker->firstName." ".$this->faker->lastName." ".
                  $this->faker->randomElement($daftar_titel),
        'jurusan_id' => $this->faker->numberBetween(1,
                  \App\Models\Jurusan::count()),
    ];
  }
}
