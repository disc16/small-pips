<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarketInformation;

class MarketInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketInformation::create([
            'user_id' => 1,
            'account_type' => 'Standard',
            'currency_id' => 8
        ]);

        MarketInformation::create([
            'user_id' => 2,
            'account_type' => 'Standard',
            'currency_id' => 8
        ]);

        MarketInformation::create([
            'user_id' => 3,
            'account_type' => 'Mini',
            'currency_id' => 8
        ]);
    }
}
