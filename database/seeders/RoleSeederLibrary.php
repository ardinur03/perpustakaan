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
        // berikan role petugas ke user dengan id 1
        $user = \App\Models\User::find(1);
        $user->assignRole('petugas');

        // berikan role member ke user dengan id 2
        $user = \App\Models\User::find(2);
        $user->assignRole('member');

        // berikan role super-admin ke user dengan id 3
        $user = \App\Models\User::find(3);
        $user->assignRole('super-admin');
    }
}
