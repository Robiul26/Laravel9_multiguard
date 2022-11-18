<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'user@email.com')->first();

        if (is_null($user)) {
            $user = new User();
            $user->name = "User";
            $user->email = "user@email.com";
            $user->password = Hash::make('123456789');
            $user->save();
            // $user->assignRole('user', 'user');
        } 
        
        $admin = Admin::where('email', 'admin@email.com')->first();

        if (is_null($admin)) {
            $admin = new Admin();
            $admin->name = "Admin";
            $admin->email = "admin@email.com";
            $admin->password = Hash::make('123456789');
            $admin->save();
        }
    }
}
