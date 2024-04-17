<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $add = new Permission();
        $add->name = 'Добавление';
        $add->slug = 'create';
        $add->save();

        $edit = new Permission();
        $edit->name = 'Редактирование';
        $edit->slug = 'edit';
        $edit->save();

        $delete = new Permission();
        $delete->name = 'Удаление';
        $delete->slug = 'delete';
        $delete->save();
    }
}
