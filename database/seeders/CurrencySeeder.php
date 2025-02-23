<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'currency' => 'AUD',
            'type' => 'Commodity',
            'correlation' => 'Gold and Coal'
        ]);

        Currency::create([
            'currency' => 'CAD',
            'type' => 'Commodity',
            'correlation' => 'Oil'
        ]);

        Currency::create([
            'currency' => 'CHF',
            'type' => 'Sage Haven',
            'correlation' => 'Neutral Country'
        ]);

        Currency::create([
            'currency' => 'EUR',
            'type' => 'Neutral',
            'correlation' => 'Neutral'
        ]);

        Currency::create([
            'currency' => 'GBP',
            'type' => 'Neutral',
            'correlation' => 'Neutral'
        ]);

        Currency::create([
            'currency' => 'JPY',
            'type' => 'Safe Haven',
            'correlation' => 'Biggest Lender'
        ]);

        Currency::create([
            'currency' => 'NZD',
            'type' => 'Commodity',
            'correlation' => 'Milk'
        ]);

        Currency::create([
            'currency' => 'USD',
            'type' => 'Safe Haven',
            'correlation' => "World's Reserve Currency and Largest Gold Reserves"
        ]);
    }
}
