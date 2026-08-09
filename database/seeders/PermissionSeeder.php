<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $permissions=['view','edit','delete','create'];

    foreach ($permissions as $permission) {

       Permission::create(['name'=>$permission]);
    }
    }
}
