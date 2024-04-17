<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $developer = Role::where('slug','admin')->first();
        $manager = Role::where('slug', 'moderator')->first();

        $user1 = new User();
        $user1->name = 'Денис';
        $user1->email = 'admin@arconix-tech.ru';
        $user1->password = bcrypt('123456');
        $user1->save();
        $user1->roles()->attach($developer);

        $user2 = new User();
        $user2->name = 'Михаил';
        $user2->email = 'slobodchikov1985@yandex.ru';
        $user2->password = bcrypt('123456');
        $user2->save();
        $user2->roles()->attach($manager);
    }
}
