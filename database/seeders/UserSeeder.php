<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'name' => 'Nguyễn Hoài Nam',
        //     'email' => 'namnguyen14103@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'user_group_id' => 1
        // ]);
        User::factory()->count(20)->create();
    }
}
