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
            ],
            [
                'faculty_name' => 'Teknik Kimia',
            ],
            [
                'faculty_name' => 'Teknik Elektro',
            ],
            [
                'faculty_name' => 'Teknik Elektro',
            ],
        ];

        foreach ($faculty as $data) {
            Faculty::create($data);
        }
    }
}
