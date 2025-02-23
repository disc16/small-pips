<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TickerPair;

class TickerPairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TickerPair::create([
            'ticker' => 'AUDCAD',
            'market_type' => 'FOREX',
            'description' => 'Australian Dollar / Canadian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'no',
            'with_account_currency_pair' => 'yes',
            'account_currency_pair' => 'AUDUSD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'AUDCHF',
            'market_type' => 'FOREX',
            'description' => 'Australian Dollar / Swiss Franc',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'AUDUSD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'AUDJPY',
            'market_type' => 'FOREX',
            'description' => 'Australian Dollar / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'AUDUSD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'AUDNZD',
            'market_type' => 'FOREX',
            'description' => 'Australian Dollar / New Zealand Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'AUDUSD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'AUDUSD',
            'market_type' => 'FOREX',
            'description' => 'Australian Dollar / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'AUDUSD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'CADCHF',
            'market_type' => 'FOREX',
            'description' => 'Canadian Dollor / Swiss Franc',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'No',
            'account_currency_pair' => 'USDCAD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'CADJPY',
            'market_type' => 'FOREX',
            'description' => 'Canadian Dollor / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'No',
            'account_currency_pair' => 'USDCAD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'CHFJPY',
            'market_type' => 'FOREX',
            'description' => 'Swiss Franc / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'No',
            'account_currency_pair' => 'USDCHF',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'EURAUD',
            'market_type' => 'FOREX',
            'description' => 'Euro / Australian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'EURCAD',
            'market_type' => 'FOREX',
            'description' => 'Euro / Canadian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'EURCHF',
            'market_type' => 'FOREX',
            'description' => 'Euro / Swiss Franc',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'EURGBP',
            'market_type' => 'FOREX',
            'description' => 'Euro / British Pound',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'EURJPY',
            'market_type' => 'FOREX',
            'description' => 'Euro / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '100000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'YES',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'EURNZD',
            'market_type' => 'FOREX',
            'description' => 'Euro / New Zealand Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'EURUSD',
            'market_type' => 'FOREX',
            'description' => 'Euro / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'EURUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'GBPAUD',
            'market_type' => 'FOREX',
            'description' => 'Britist Pound / Australian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GBPUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'GBPCAD',
            'market_type' => 'FOREX',
            'description' => 'Britist Pound / Canadian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GBPUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'GBPCHF',
            'market_type' => 'FOREX',
            'description' => 'Britist Pound / Swiss Franc',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GBPUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'GBPJPY',
            'market_type' => 'FOREX',
            'description' => 'Britist Pound / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GBPUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'GBPNZD',
            'market_type' => 'FOREX',
            'description' => 'Britist Pound / New Zealand Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GBPUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'GBPUSD',
            'market_type' => 'FOREX',
            'description' => 'Britist Pound / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GBPUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'NZDCAD',
            'market_type' => 'FOREX',
            'description' => 'New Zealand Dollar / Canadian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'NZDUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'NZDCHF',
            'market_type' => 'FOREX',
            'description' => 'New Zealand Dollar / Swiss Franc',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'NZDUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'NZDJPY',
            'market_type' => 'FOREX',
            'description' => 'New Zealand Dollar / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'NZDUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'NZDUSD',
            'market_type' => 'FOREX',
            'description' => 'New Zealand Dollar / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'NZDUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'USDCAD',
            'market_type' => 'FOREX',
            'description' => 'U.S. Dollar / Canadian Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk Off',
            'sentiment_short' => 'Risk On',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'Yes',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => '',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'USDCHF',
            'market_type' => 'FOREX',
            'description' => 'U.S. Dollar / Swiss Franc',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '1000000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'Yes',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => '',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'USDJPY',
            'market_type' => 'FOREX',
            'description' => 'U.S. Dollar / Japanese Yen',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '100000',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'Yes',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => '',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'XAUUSD',
            'market_type' => 'COMMODITIES',
            'description' => 'Gold (XAU/USD)',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixede',
            'board_lot' => '0.01',
            'standard_lot' => '100',
            'mini_lot' => '10',
            'micro_lot' => '10',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'no',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'GOLD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'XAGUSD',
            'market_type' => 'COMMODITIES',
            'description' => 'Silver (XAG/USD)',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.01',
            'standard_lot' => '5000',
            'mini_lot' => '50',
            'micro_lot' => '50',
            'pip_multiplier' => '0.0001',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'SILVER',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'BCOUSD',
            'market_type' => 'COMMODITIES',
            'description' => 'Brent Crude Oil        ',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.1',
            'standard_lot' => '1000',
            'mini_lot' => '100',
            'micro_lot' => '100',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'YES',
            'account_currency_pair' => 'BRENT OIL',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'USOIL',
            'market_type' => 'COMMODITIES',
            'description' => 'WTI Oil',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.1',
            'standard_lot' => '1000',
            'mini_lot' => '100',
            'micro_lot' => '100',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'WTI OIL',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'NATGAS',
            'market_type' => 'COMMODITIES',
            'description' => 'Natural Gas',
            'position' => 'Long',
            'sentiment_long' => 'Mixed',
            'sentiment_short' => 'Mixed',
            'board_lot' => '0.1',
            'standard_lot' => '10000',
            'mini_lot' => '1000',
            'micro_lot' => '100',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'NGAS',
            'status' => 'inactive'
        ]);
        TickerPair::create([
            'ticker' => 'BTCUSD',
            'market_type' => 'CRYPTO',
            'description' => 'Bitcoin / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '1',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'BTCUSD',
            'status' => 'active'
        ]);
        TickerPair::create([
            'ticker' => 'ETHUSD',
            'market_type' => 'CRYPTO',
            'description' => 'Ethereum / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '1',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'BTCUSD',
            'status' => 'active'
        ]);

        TickerPair::create([
            'ticker' => 'SOLUSD',
            'market_type' => 'CRYPTO',
            'description' => 'Solana / U.S. Dollar',
            'position' => 'Long',
            'sentiment_long' => 'Risk On',
            'sentiment_short' => 'Risk Off',
            'board_lot' => '0.01',
            'standard_lot' => '1',
            'mini_lot' => '10000',
            'micro_lot' => '1000',
            'pip_multiplier' => '0.01',
            'account_base_currency' => 'No',
            'with_account_currency_pair' => 'Yes',
            'account_currency_pair' => 'BTCUSD',
            'status' => 'active'
        ]);
    }
}
