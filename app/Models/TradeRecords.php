<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeRecords extends Model
{
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tickerPair(): belongsTo
    {
        return $this->belongsTo(TickerPair::class, 'ticker_id');
    }

    public function entryTime(): belongsTo
    {
        return $this->belongsTo(TradingTime::class, 'entry_time_id');
    }

    public function actualExitTime(): belongsTo
    {
        return $this->belongsTo(TradingTime::class, 'actual_exit_time_id');
    }

    public function systemExitTime(): belongsTo
    {
        return $this->belongsTo(TradingTime::class, 'system_exit_time_id');
    }

    public function currencyPrice(): belongsTo
    {
        return $this->belongsTo(TradingTime::class, 'currency_price_id');
    }

    public function tradingStrategy(): belongsTo
    {
        return $this->belongsTo(TradingStrategy::class, 'currency_price_id');
    }
}
