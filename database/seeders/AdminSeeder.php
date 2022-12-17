<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create super admin
        $super_admin = \App\Models\User::create([
            'username' => 'Neisya',
            'email' => 'neisya@ardinur.tech',
            'password' => bcrypt('12345678'),
        ]);
        $super_admin->assignRole('super-admin');

        // create petugas
        $petugas = \App\Models\User::create([
            'username' => 'ardinur',
            'email' => 'info@ardinur.tech',
            'password' => bcrypt('12345678'),
        ]);
        $petugas->assignRole('petugas');
        // assign petugas ke data master librarian
        \App\Models\Librarian::create([
            'user_id' => $petugas->id,
        ]);
    }
}
