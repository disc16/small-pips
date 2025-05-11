<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountType;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountType::create([
            'name' => 'Basic',
            'note' => 'Free'
        ]);

        AccountType::create([
            'name' => 'Standard',
            'note' => 'Tier 1 Paid'
        ]);

        AccountType::create([
            'name' => 'Premium',
            'note' => 'Tier 2 Paid'
        ]);
    }
}
