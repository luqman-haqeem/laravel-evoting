<?php

namespace Database\Seeders;

use App\Voter;
use Illuminate\Database\Seeder;

class VoterSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Voter::create([
            'faculties_id' => 1,
            'election_id' => 1,
            'matric_number' =>  '12342',
            'name' => 'Ali'
        ]);

        Voter::create([
            'faculties_id' => 2,
            'election_id' => 1,

            'matric_number' =>  '123123',
            'name' =>'Ahmad'
        ]);

        Voter::create([
            'faculties_id' => 3,
            'election_id' => 1,

            'matric_number' =>  '12344',
            'name' => 'Salman'
        ]);

        Voter::create([
            'faculties_id' => 4,
            'election_id' => 1,

            'matric_number' =>  '110939',
            'name' => 'Sofia'
        ]);
    }
}
