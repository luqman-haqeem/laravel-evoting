<?php

namespace Database\Seeders;

use App\Election;
use Illuminate\Database\Seeder;

class ElectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Election::create([
            'name' => 'Election 1',
            'start_at' => now(),
            'end_at' => now(),
        ]);
    }
}
