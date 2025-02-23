<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserPerson;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@trade.com',
            'password' => 'admin@trade.com',
        ])->assignRole('Admin');

        $user1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@trade.com',
            'password' => 'trader1'
        ])->assignRole('User');

        $user2 = User::factory()->create([
            'name' => 'Jane Dee',
            'email' => 'jane.dee@trade.com',
            'password' => 'trader1'
        ])->assignRole('User');

        \Log::info('USER: ' . var_export($admin->id, true));

        UserPerson::create(['user_id' => $admin->id, 'first_name' => "Admin", 'last_name' => 'User']);
        UserPerson::create(['user_id' => $user1->id, 'first_name' => 'John', 'last_name' => 'Doe']);
        UserPerson::create(['user_id' => $user2->id, 'first_name' => 'Jane', 'last_name' => 'Dee']);
    }
}
