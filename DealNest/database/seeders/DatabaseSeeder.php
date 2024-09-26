<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@exammple.com',
        ]);
        User::factory()->create([
            'name' => 'Kind',
            'email' => 'binhh0846@gmail.com'
        ]);
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole($role);
    }
}
