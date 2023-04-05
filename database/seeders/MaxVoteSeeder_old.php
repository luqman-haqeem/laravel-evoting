<?php

namespace Database\Seeders;

use App\MaxVote;
use Illuminate\Database\Seeder;

class MaxVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MaxVote::create([
            'election_id' => '1',
            'sections_id' => '1',
            'max_votes' => '1',
        ]);
        MaxVote::create([
            'election_id' => '1',
            'sections_id' => '2',
            'max_votes' => '1',
        ]);
        MaxVote::create([
            'election_id' => '1',
            'sections_id' => '3',
            'max_votes' => '1',
        ]);
        MaxVote::create([
            'election_id' => '1',
            'sections_id' => '4',
            'max_votes' => '1',
        ]);
        MaxVote::create([
            'election_id' => '1',
            'sections_id' => '5',
            'max_votes' => '1',
        ]);
        MaxVote::create([
            'election_id' => '1',
            'sections_id' => '6',
            'max_votes' => '1',
        ]);
    }
}
