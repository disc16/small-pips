<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CapitalAndRiskMgmt;

class CapitalAndRiskMgmtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CapitalAndRiskMgmt::create([
            'user_id' => 2,
            'capital' => 2000,
            'risk_percentage' => 0.025,
            'risk_amount' => 50,
            'targets' => json_encode([
                'target1' => [
                    'rrr' => 1.5,
                    'pips' => 35,
                    'min_pips' => 26
                ],
                'target2' => [
                    'rrr' => 2.0,
                    'pips' => 25,
                    'min_pips' => 16
                ],
                'target3' => [
                    'rrr' => 2.5,
                    'pips' => 15,
                    'min_pips' => 0
                ]
            ])
        ]);

        CapitalAndRiskMgmt::create([
            'user_id' => 3,
            'capital' => 2000,
            'risk_percentage' => 0.025,
            'risk_amount' => 50,
            'targets' => json_encode([
                'target1' => [
                    'rrr' => 1.5,
                    'pips' => 35,
                    'min_pips' => 26
                ],
                'target2' => [
                    'rrr' => 2.0,
                    'pips' => 25,
                    'min_pips' => 16
                ],
                'target3' => [
                    'rrr' => 2.5,
                    'pips' => 15,
                    'min_pips' => 0
                ]
            ])
        ]);
    }
}
