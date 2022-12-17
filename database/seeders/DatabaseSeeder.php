<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategoriesBookSeeder::class,
            FacultySeeder::class,
            StudyProgramSeeder::class,
            EventSeeder::class,
        ]);
        \App\Models\Member::factory(10)->create();
        // \App\Models\Book::factory(10)->create();
        $this->call([
            RoleSeederLibrary::class,
            AdminSeeder::class,
        ]);
    }
}
