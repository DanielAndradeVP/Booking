<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Criação de role
        $roleSudo = Role::create(['name' => 'sudo']);
        $roleColaborator = Role::create(['name' => 'colaborator']);
        $roleUser = Role::create(['name' => 'user']);

        // Criação de permissão
        $permissionAssign = Permission::create(['name' => 'admin']);
        $permissionSale = Permission::create(['name' => 'sale']);
        $permissionPurchase = Permission::create(['name' => 'teste']);

        // Atribuição de permissão ao role
        $roleSudo->givePermissionTo($permissionAssign);
        $roleColaborator->givePermissionTo($permissionSale);
        $roleUser->givePermissionTo($permissionPurchase);

        // Criação de usuário com o role sudo
        $user = User::create([
            'name' => 'sudo',
            'email' => 'sudoadmin@hotmail.com',
            'password' => 'chama1234',
        ]);

        // Atribuição do role ao usuário
        $user->assignRole($roleSudo);
    }
}
