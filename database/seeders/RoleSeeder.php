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
        $admin = new Role();
        $admin->name = 'Администратор';
        $admin->slug = 'admin';
        $admin->save();

        $moderator = new Role();
        $moderator->name = 'Модератор';
        $moderator->slug = 'moderator';
        $moderator->save();

        $manager = new Role();
        $manager->name = 'Менеджер';
        $manager->slug = 'manager';
        $manager->save();

        $legal = new Role();
        $legal->name = 'Юрист';
        $legal->slug = 'legal';
        $legal->save();
    }
}
