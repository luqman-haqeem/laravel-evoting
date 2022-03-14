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
            'name' => 'General',
        ]);

        Section::create([
            'name' => 'Faculty',
        ]);

    }
}
