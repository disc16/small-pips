<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TradingStrategy;
use App\Models\User;

class TradingStrategySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::findOrFail(1);
        $this->seedStrategy($admin->id);

        $user1 =  User::findOrFail(2);
        $this->seedStrategy($user1->id);

        $user2  = User::findOrFail(3);
        $this->seedStrategy($user2->id);
    }

    public function seedStrategy($id)
    {
        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Momentum - Slingshot',
            'type' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Momentum - Boomers',
            'type' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Swing - Pullback',
            'type' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Swing - Range',
            'type' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Position - Coils',
            'type' => 'Waiting Game'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Position - Bluesky',
            'type' => 'Waiting Game'
        ]);
        
        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Capitulation - Reversal',
            'type' => 'Counter Trading'
        ]);
        
        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Capitulation - Retest',
            'type' => 'Counter Trading'
        ]);

    }
}
