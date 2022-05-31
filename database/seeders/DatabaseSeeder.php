<?php
namespace Database\Seeders;

use App\Faculty;
use App\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Voter;
use Database\Seeders\SectionSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\VoterSeedeer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //     User::create([
    //         'name' => 'Admin',
    //         'last_name' => 'Admin',
    //         'email' => 'admin@admin.com',
    //         'email_verified_at' => now(),
    //         'password' => Hash::make('password'), // password
    //         'remember_token' => Str::random(10),
    //    ]);

        // Section::create([
        //     'name' => 'General',
        // ]);

        // Section::create([
        //     'name' => 'Faculty',
        // ]);

        // Faculty::create([
        //     'name' => 'FPM',
        //     'fullname' => 'FAKULTI PENGURUSAN DAN MUAMALAH',
        // ]);
        // Faculty::create([
        //     'name' => 'FSTM',
        // 'fullname' => 'FAKULTI SAINS DAN TEKNOLOGI MAKLUMAT',
        // ]);
        // Faculty::create([
        //     'name' => 'FPPI',
        //     'fullname' => 'FAKULTI PENGAJIAN PERADABAN ISLAM',
        // ]);
        // Faculty::create([
        //     'name' => 'FP',
        //     'fullname' => 'FAKULTI PENDIDIKAN',
        // ]);
        // Faculty::create([
        //     'name' => 'FSU',
        //     'fullname' => 'FAKULTI SYARIAH DAN UNDANG-UNDANG',
        // ]);

        // Voter::create([
        //     'faculties_id' => 1,
        //     'matric_number' =>  '12342',
        //     'name' => 'ALi'
        // ]);

        // Voter::create([
        //     'faculties_id' => 2,
        //     'matric_number' =>  '123123',
        //     'name' =>'Ahmad'
        // ]);

        // Voter::create([
        //     'faculties_id' => 3,
        //     'matric_number' =>  '12344',
        //     'name' => 'LODd'
        // ]);

        // Voter::create([
        //     'faculties_id' => 4,
        //     'matric_number' =>  '110939',
        //     'name' => 'aiwnnd'
        // ]);


        // factory(App\Voter::class, 100)->create();
        // $this->call(UsersTableSeeder::class);
        $this->call(ElectionSeeder::class);

        $this->call(FacultySeeder::class);
        $this->call(VoterSeedeer::class);
        $this->call(SectionSeeder::class);
        // $this->call(UserSeeder::class);

    }
}
