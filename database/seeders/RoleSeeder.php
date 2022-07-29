<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ??? */
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::Call('cache:clear');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::Call('cache:clear');

        //dd('Aca');
       /* Roles para los usuarios del Sistema */
       $rolRoot = Role::create(['name' => 'Root']);
       $roleAdmin = Role::create(['name' => 'Administrador General']);
       $roleUserOpe = Role::create(['name' => 'Usuario Operaciones']);
       $rolUserGrte = Role::create(['name' => 'Usuario Generente']);



        /* Permisos para los roles escritorio */
        Permission::create(['name' => 'dashboard'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe, $rolUserGrte]);


        /* Permisos para los roles Usuario */
         Permission::create(['name' => 'users.index'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.show'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.create'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.store'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.edit'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.update'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.destroy'])
        ->syncRoles([$rolRoot, $roleAdmin]);
          Permission::create(['name' => 'users.clave'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe, $rolUserGrte]);
          Permission::create(['name' => 'users.updateClave'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe, $rolUserGrte]);


         /* Permisos para los roles ventas */
         Permission::create(['name' => 'ventas.index'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe, $rolUserGrte]);
          Permission::create(['name' => 'ventas.show'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe, $rolUserGrte]);
          Permission::create(['name' => 'ventas.create'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe]);
          Permission::create(['name' => 'ventas.store'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe]);
          Permission::create(['name' => 'ventas.edit'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe]);
          Permission::create(['name' => 'ventas.update'])
        ->syncRoles([$rolRoot, $roleAdmin, $roleUserOpe]);
          Permission::create(['name' => 'ventas.destroy'])
        ->syncRoles([$rolRoot, $roleAdmin]);
   }
}
