<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPerson;
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

        $this->call([
            RoleAndPermissionSeeder::class,
            TickerPairSeeder::class,
            EconomicIndicatorSeeder::class,
            TradingTimeSeeder::class,
            CapitalAndRiskMgmtSeeder::class,
            UserSeeder::class,
            TradingStrategySeeder::class,
            CurrencySeeder::class,
            AccountTypeSeeder::class,
            MarketInformationSeeder::class,
        ]);

        

        


        
    }

}
