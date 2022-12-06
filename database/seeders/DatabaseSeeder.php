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
        \App\Models\User::factory(20)->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategoriesBookSeeder::class,
            RoleSeederLibrary::class,
            StudyProgramSeeder::class,
            FacultySeeder::class,
        ]);
        \App\Models\Book::factory(2000)->create();
        \App\Models\Member::factory(19)->create();
    }
}
