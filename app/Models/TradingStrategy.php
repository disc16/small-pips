<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradingStrategy extends Model
{
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
