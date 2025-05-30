<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketInformation extends Model
{
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accountType(): belongsTo
    {
        return $this->belongsTo(AccountType::class);
    }
}
