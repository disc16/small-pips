<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EconomicIndicators;

class EconomicIndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EconomicIndicators::create([
            'name' => 'Interest Rate',
            'group' => 'Central Bank'
        ]);

        EconomicIndicators::create([
            'name' => 'Employment',
            'group' => 'Employment'
        ]);

        EconomicIndicators::create([
            'name' => 'Inflation Rate',
            'group' => 'Inflation'
        ]);

        EconomicIndicators::create([
            'name' => 'Consumer Price Index',
            'group' => 'Inflation'
        ]);

        EconomicIndicators::create([
            'name' => 'Producer Price Index',
            'group' => 'Inflation'
        ]);

        EconomicIndicators::create([
            'name' => 'Capacity Utilization',
            'group' => 'Production'
        ]);

        EconomicIndicators::create([
            'name' => 'Durable Goods Orders',
            'group' => 'Production'
        ]);

        EconomicIndicators::create([
            'name' => 'Factory Orders',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'Machine Orders',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'Global Dairy Trade Price Index',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'GDP',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'Industrial Production',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'Manufacturing Production',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'China PMI',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'Manufacturing PMI',
            'group' => 'Production'
        ]);
        EconomicIndicators::create([
            'name' => 'Building Permits',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Business Confidence',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Consumer Confidence',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Household Spending',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Housing Starts',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Manufacturing Sales',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'New Home Sales',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Personal Spending',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Retail Sales',
            'group' => 'Spending'
        ]);
        EconomicIndicators::create([
            'name' => 'Balance of Trade',
            'group' => 'Trade'
        ]);


        

    }
}
