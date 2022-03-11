<?php

use App\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
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
    
        Faculty::create([
            'name' => 'FPM',
            'fullname' => 'FAKULTI PENGURUSAN DAN MUAMALAH',
        ]);
        Faculty::create([
            'name' => 'FSTM',
        'fullname' => 'FAKULTI SAINS DAN TEKNOLOGI MAKLUMAT',
        ]);
        Faculty::create([
            'name' => 'FPPI',
            'fullname' => 'FAKULTI PENGAJIAN PERADABAN ISLAM',
        ]);
        Faculty::create([
            'name' => 'FP',
            'fullname' => 'FAKULTI PENDIDIKAN',
        ]);
        Faculty::create([
            'name' => 'FSU',
            'fullname' => 'FAKULTI SYARIAH DAN UNDANG-UNDANG',
        ]);

        // $this->call(UsersTableSeeder::class);
        // $this->call(FacultySeeder::class);
    }
}
