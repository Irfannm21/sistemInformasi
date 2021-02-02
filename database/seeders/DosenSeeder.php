<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Dosen::Factory()->count(10)->create();
    }
}
