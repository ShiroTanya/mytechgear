<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
        	'admin_name' => 'HoangLong',
        	'admin_email' => 'hoanglong123456@gmail.com',
        	'admin_phone' => '51252667',
        	'admin_password' => md5('123456')
        ]);

        $author = Admin::create([
        	'admin_name' => 'duydat',
        	'admin_email' => 'duydat123456@gmail.com',
        	'admin_phone' => '51252537',
        	'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
        	'admin_name' => 'hongphong',
        	'admin_email' => 'hongphong123456@gmail.com',
        	'admin_phone' => '512525007',
        	'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
