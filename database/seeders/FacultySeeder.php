<?php

namespace Database\Seeders;

use App\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 5 main faculty
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
    }
}
