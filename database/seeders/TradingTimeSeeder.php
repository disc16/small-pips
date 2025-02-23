<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TradingTime;
use Carbon\Carbon;

class TradingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','6:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "00:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','6:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "00:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','7:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "01:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','6:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "01:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','8:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "02:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','8:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "02:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','9:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "03:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','9:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "03:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','10:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "04:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','10:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "04:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','11:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "05:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','11:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "05:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','12:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "06:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','12:30 AM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "6:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','01:00 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "7:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','01:30 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "7:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','02:00 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "8:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','02:30 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "8:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','03:00 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "9:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','03:30 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "9:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','03:30 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "9:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','03:30 PM')->toTimeString(),
            'session' => 'AS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "9:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','04:00 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "10:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','04:30 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "10:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','05:00 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "11:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','05:30 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "11:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','06:00 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "12:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','06:30 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "12:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','07:00 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "13:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','07:30 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "13:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','08:00 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "14:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','08:30 PM')->toTimeString(),
            'session' => 'LS',
            'forex_time' => Carbon::CreateFromFormat('H:i', "14:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','09:00 PM')->toTimeString(),
            'session' => 'US',
            'forex_time' => Carbon::CreateFromFormat('H:i', "15:00")->toTimeString()
        ]);
        
        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','09:30 PM')->toTimeString(),
            'session' => 'US',
            'forex_time' => Carbon::CreateFromFormat('H:i', "15:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','10:00 PM')->toTimeString(),
            'session' => 'US',
            'forex_time' => Carbon::CreateFromFormat('H:i', "16:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','10:30 PM')->toTimeString(),
            'session' => 'US',
            'forex_time' => Carbon::CreateFromFormat('H:i', "16:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','11:00 PM')->toTimeString(),
            'session' => 'US',
            'forex_time' => Carbon::CreateFromFormat('H:i', "17:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','11:30 PM')->toTimeString(),
            'session' => 'US',
            'forex_time' => Carbon::CreateFromFormat('H:i', "17:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','12:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "18:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','12:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "18:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','01:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "19:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','01:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "19:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','02:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "20:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','02:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "20:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','03:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "21:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','03:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "21:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','04:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "22:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','04:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "22:30")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','05:00 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "23:00")->toTimeString()
        ]);

        TradingTime::create([
            'ph_time' => Carbon::createFromFormat('g:i A','05:30 AM')->toTimeString(),
            'session' => 'No Trade',
            'forex_time' => Carbon::CreateFromFormat('H:i', "23:30")->toTimeString()
        ]);
    }
}
