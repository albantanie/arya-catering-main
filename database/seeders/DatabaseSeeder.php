<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createRoles();
        $this->createAdmin();
        $this->createRegularUser();
        $this->createMenu();
    }

    private function createRoles(): void
    {
        $roles = ['admin', 'user'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }

    private function createAdmin(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sinathan.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
    }

    private function createRegularUser(): void
    {
        User::create([
            'name' => 'Arya',
            'email' => 'arya@sinathan.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);
        User::create([
            'name' => 'Nathan',
            'email' => 'nathan@sinathan.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);
    }

    private function createMenu(): void
    {
        $menus = [
            ['name' => 'Bakso', 'price' => 10000, 'description' => 'Bakso enak'],
            ['name' => 'Mie Ayam', 'price' => 12000, 'description' => 'Mie Ayam enak'],
            ['name' => 'Nasi Goreng', 'price' => 15000, 'description' => 'Nasi Goreng enak'],
            ['name' => 'Soto Ayam', 'price' => 13000, 'description' => 'Soto Ayam enak'],
            ['name' => 'Ketoprak', 'price' => 10000, 'description' => 'Ketoprak enak'],
            ['name' => 'Sayur Asem', 'price' => 12000, 'description' => 'Sayur Asem enak'],
            ['name' => 'Tahu Bulat', 'price' => 15000, 'description' => 'Tahu Bulat enak'],
            ['name' => 'Soto Betawi', 'price' => 13000, 'description' => 'Soto Betawi enak'],
            ['name' => 'Nasi Bakar', 'price' => 10000, 'description' => 'Nasi Bakar enak'],
            ['name' => 'Semur Ayam', 'price' => 12000, 'description' => 'Semur Ayam enak'],
            ['name' => 'Telur Rebus', 'price' => 15000, 'description' => 'Telur Rebus enak'],
            ['name' => 'Ayam Bakar', 'price' => 13000, 'description' => 'Ayam Bakar enak'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
