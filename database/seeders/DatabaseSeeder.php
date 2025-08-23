<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'user_group_id' => '01k3bj4qx8m1wjp8chj17ehe2m',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678'
        ]);
    }
}
