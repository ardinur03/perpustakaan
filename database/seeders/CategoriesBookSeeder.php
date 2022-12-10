<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_categories = [
            [
                'category_name' => 'Novel'
            ],
            [
                'category_name' => 'Komik'
            ],
            [
                'category_name' => 'Biografi'
            ],
            [
                'category_name' => 'Ensiklopedia'
            ],
            [
                'category_name' => 'Kamus'
            ],
            [
                'category_name' => 'Majalah'
            ],
            [
                'category_name' => 'Lainnya'
            ],
            [
                'category_name' => 'Agama'
            ],
            [
                'category_name' => 'Kesehatan'
            ],
            [
                'category_name' => 'Keluarga'
            ],
            [
                'category_name' => 'Pendidikan'
            ],
            [
                'category_name' => 'Hobi'
            ],
            [
                'category_name' => 'Kuliner'
            ],
            [
                'category_name' => 'Olahraga'
            ],
            [
                'category_name' => 'Pemrograman'
            ],
            [
                'category_name' => 'Teknologi'
            ],
            [
                'category_name' => 'Bisnis'
            ],
            [
                'category_name' => 'Komputer'
            ],
            [
                'category_name' => 'Internet'
            ],
            [
                'category_name' => 'Sains'
            ],
            [
                'category_name' => 'Matematika'
            ],
            [
                'category_name' => 'Filsafat'
            ],
            [
                'category_name' => 'Politik'
            ],
            [
                'category_name' => 'Hukum'
            ],
            [
                'category_name' => 'Ekonomi'
            ],
            [
                'category_name' => 'Geografi'
            ],
            [
                'category_name' => 'Sosial'
            ],
            [
                'category_name' => 'Sejarah'
            ],
        ];

        foreach ($data_categories as $data_category) {
            \App\Models\Category::create($data_category);
        }
    }
}
