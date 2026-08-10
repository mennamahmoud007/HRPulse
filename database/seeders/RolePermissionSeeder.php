<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $employee=Role::where('name','employee')->first();
       $manager=Role::where('name','manager')->first();
       $hr=Role::where('name','hr')->first();

       $edit=Permission::where('name','edit')->first();
       $view=Permission::where('name','view')->first();
       $delete=Permission::where('name','delete')->first();
       $create=Permission::where('name','create')->first();

       $employee->permissions()->attach([
        $view->id,]
       );

       $manager->permissions()->attach([
        $view->id,
        $edit->id
       ]);

       $hr->permissions()->attach([

       $view->id,
       $edit->id,
       $delete->id,
       $create->id
       ]);
    }
}
