<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TickerPair extends Model
{
    public function tickerPair(): hasMany
    {
        return $this->hasMany(TradeRecords::class, 'ticker_id');
    }
}
