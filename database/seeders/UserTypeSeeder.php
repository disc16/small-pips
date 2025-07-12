<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basic = UserType::create(['user_type' => 'Basic', 'pricing' => '0']);
        $basic->assignRole(['Basic']);

        $standard = UserType::create(['user_type' => 'Standard', 'pricing' => '2999']);
        $standard->assignRole(['Standard']);

        $premium = userType::create(['user_type' => 'Premium', 'pricing' => '4999']);
        $premium->assignRole(['Premium']);
    }
}
