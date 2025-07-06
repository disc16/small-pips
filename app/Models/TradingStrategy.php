<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradingStrategy extends Model
{
    protected $fillable = ['user_id', 'strategy'];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
