<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MahasiswaMatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MahasiswaMatakuliah::Factory()->count(10)->create();
    }
}
