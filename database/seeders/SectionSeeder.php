<?php

namespace Database\Seeders;

use App\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Section::create([
            'name' => 'GENERAL',
        ]);

        Section::create([
            'name' => 'FPM',
        ]);
        Section::create([
            'name' => 'FSTM',
        ]);
        Section::create([
            'name' => 'FPPI',
        ]);
        Section::create([
            'name' => 'FP',
        ]);
        Section::create([
            'name' => 'FSU',
        ]);

    }
}
