<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JurusanFactory extends Factory
{
  protected $model = Jurusan::class;

  public function definition()
  {
    $daftar_jurusan = ["Ilmu Komputer",
                       "Sistem Informasi",
                       "Teknik Informatika"];
    return [
        'nama' => $this->faker->unique()->randomElement($daftar_jurusan),
        'kepala_jurusan' => "Dr. ".$this->faker->firstName." ".
                            $this->faker->lastName,
        'daya_tampung'   => $this->faker->numberBetween(5,8)*10,
    ];
  }
}
