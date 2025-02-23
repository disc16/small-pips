<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CurrencyPrice extends Model
{
    public function currencyPrice(): hasMany
    {
        return $this->hasMany(TradeRecords::class, 'currency_price_id');
    }
}
