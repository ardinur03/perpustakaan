<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi = [
            [
                'study_name' => 'D3 Teknik Informatika',
                'faculty_id' => 1
            ],
            [
                'study_name' => 'D4 Teknik Informatika',
                'faculty_id' => 1
            ],
            [
                'study_name' => 'D3 Teknik Kimia',
                'faculty_id' => 2
            ],
            [
                'study_name' => 'D4 Teknik Kimia Produksi Bersih',
                'faculty_id' => 2
            ],
            [
                'study_name' => 'D3 Teknik Elektronika',
                'faculty_id' => 3
            ],
            [
                'study_name' => 'D4 Teknik Elektronika',
                'faculty_id' => 3
            ],
            [
                'study_name' => 'D3 Teknik Telekomunikasi',
                'faculty_id' => 4
            ],
            [
                'study_name' => 'D4 Teknik Telekomunikasi',
                'faculty_id' => 4
            ]
        ];

        foreach ($prodi as $data) {
            StudyProgram::create($data);
        }
    }
}
