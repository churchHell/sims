<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addRole(1, 'user', 'Пользователь');
        $this->addRole(2, 'admin', 'Администратор');
        $this->addRole(3, 'super', 'Супер');
    }

    private function addRole(int $id, string $slug, string $name): void
    {
        Role::firstOrCreate(compact('id', 'slug', 'name'));
    }
}
