<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeederLibrary extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // berikan role member ke semua user yang sudah ada
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            $user->assignRole('member');
        }
    }
}
