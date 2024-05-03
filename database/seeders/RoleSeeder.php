<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = new Role();
        $superAdmin->name = 'Супер админ';
        $superAdmin->slug = 'super_admin';
        $superAdmin->save();

        $admin = new Role();
        $admin->name = 'Администратор';
        $admin->slug = 'admin';
        $admin->save();

        $user = new Role();
        $user->name = 'Пользователь';
        $user->slug = 'user';
        $user->save();
    }
}
