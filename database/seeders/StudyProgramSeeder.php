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
            ],
            [
                'study_name' => 'D4 Teknik Informatika'
            ],
            [
                'study_name' => 'D3 Teknik Kimia'
            ],
            [
                'study_name' => 'D4 Teknik Kimia Produksi Bersih'
            ],
            [
                'study_name' => 'D3 Teknik Elektronika'
            ],
            [
                'study_name' => 'D4 Teknik Elektronika'
            ],
            [
                'study_name' => 'D3 Teknik Telekomunikasi'
            ],
            [
                'study_name' => 'D4 Teknik Telekomunikasi'
            ]
        ];

        foreach ($prodi as $data) {
            StudyProgram::create($data);
        }
    }
}
