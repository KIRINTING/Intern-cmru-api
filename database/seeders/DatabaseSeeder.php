<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'Admin',
            'password' => Hash::make('p@ssw0rd'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'username' => 'SaleUser',
            'password' => Hash::make('p@ssw0rd'),
            'role' => 'sale',
        ]);

        User::factory()->create([
            'username' => 'AccountUser',
            'password' => Hash::make('p@ssw0rd'),
            'role' => 'account',
        ]);

        User::factory()->create([
            'username' => 'ApproverUser',
            'password' => Hash::make('p@ssw0rd'),
            'role' => 'approver',
        ]);
    }
}
