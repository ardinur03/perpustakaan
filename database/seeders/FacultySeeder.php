<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty = [
            [
                'faculty_name' => 'Teknik Komputer dan Informatika',
                'study_program_id' => 1
            ],
            [
                'faculty_name' => 'Teknik Komputer dan Informatika',
                'study_program_id' => 2
            ],
            [
                'faculty_name' => 'Teknik Kimia',
                'study_program_id' => 3
            ],
            [
                'faculty_name' => 'Teknik Kimia',
                'study_program_id' => 4
            ],
            [
                'faculty_name' => 'Teknik Elektro',
                'study_program_id' => 5
            ],
            [
                'faculty_name' => 'Teknik Elektro',
                'study_program_id' => 6
            ],
            [
                'faculty_name' => 'Teknik Elektro',
                'study_program_id' => 7
            ],
            [
                'faculty_name' => 'Teknik Elektro',
                'study_program_id' => 8
            ]
        ];

        foreach ($faculty as $data) {
            Faculty::create($data);
        }
    }
}
