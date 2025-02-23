<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TradingTime extends Model
{
    public function actualExitTime(): hasMany
    {
        return $this->hasMany(TradeRecords::class, 'actual_exit_time_id');
    }

    public function systemExitTime(): hasMany
    {
        return $this->hasMany(TradeRecords::class, 'system_exit_time_id');
    }
}
