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
            'notes' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Momentum - Boomers',
            'notes' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Swing - Pullback',
            'notes' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Swing - Range',
            'notes' => 'Trend Following'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Position - Coils',
            'notes' => 'Waiting Game'
        ]);

        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Position - Bluesky',
            'notes' => 'Waiting Game'
        ]);
        
        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Capitulation - Reversal',
            'notes' => 'Counter Trading'
        ]);
        
        TradingStrategy::create([
            'user_id' => $id,
            'strategy' => 'Capitulation - Retest',
            'notes' => 'Counter Trading'
        ]);

    }
}
