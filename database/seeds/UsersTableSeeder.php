<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
        $authorRole = Role::where('name','employer')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123')
        ]);

        $author = User::create([
            'name' => 'Employer User',
            'email' => 'nv@gmail.com',
            'password' => Hash::make('123123')
        ]);

        $user = User::create([
            'name' => 'Genetic User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123123')
        ]);


        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
