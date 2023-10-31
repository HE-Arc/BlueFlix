<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admini',
            'email' => 'admini@strator.ch',
            'password' => bcrypt('admin1234'),
            'created_at' => '2023-10-30 16:57:38',
            'updated_at' => '2023-10-30 16:57:38',
            'firstname' => 'Admini',
            'lastname' => 'Strator',
            'username' => 'admin',
        ]);

        User::create([
            'name' => 'Utili',
            'email' => 'utili@sateur.ch',
            'password' => bcrypt('user1234'),
            'created_at' => '2023-10-30 17:00:23',
            'updated_at' => '2023-10-30 17:00:23',
            'firstname' => 'Utili',
            'lastname' => 'Sateur',
            'username' => 'user',
        ]);
    }
}
