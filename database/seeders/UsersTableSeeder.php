<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Administrator";
        $user->level = "admin";
        $user->avatar = "https://static-00.iconduck.com/assets.00/user-icon-2048x2048-ihoxz4vq.png";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("admin123");
        $user->save();
    }
}
