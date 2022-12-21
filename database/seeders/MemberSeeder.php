<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_member_1 = \App\Models\User::create([
            'username' => 'madya',
            'user_code' => '738371571335747777',
            'email' => 'madya@ardinur.tech',
            'password' => bcrypt('12345678'),
        ]);

        Member::create([
            'member_code' => '738371571335747777',
            'user_id' => $user_member_1->id,
            'study_program_id' => 1,
            'member_name' => 'Jurnal Madya',
            'gender' => 'Laki-laki',
            'phone_number' => '+62234567890',
            'address' => 'Jl. Kebon Jeruk No. 1',
            'created_at' => now(),
        ]);

        $user_member_1->assignRole('member');

        $user_member_2 = \App\Models\User::create([
            'username' => 'kevin',
            'user_code' => '211511017',
            'email' => 'kevin@ardinur.tech',
            'password' => bcrypt('12345678'),
        ]);

        Member::create([
            'member_code' => '211511017',
            'user_id' => $user_member_2->id,
            'study_program_id' => 1,
            'member_name' => 'kevin Ibrahim',
            'gender' => 'Laki-laki',
            'phone_number' => '+62234511311',
            'address' => 'Jl. Kebon Mangga No. 1',
            'created_at' => now(),
        ]);
        $user_member_2->assignRole('member');
    }
}
