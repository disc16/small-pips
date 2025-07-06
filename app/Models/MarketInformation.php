<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketInformation extends Model
{
    protected $fillable = ['user_id', 'account_type_id', 'currency_id'];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accountType(): belongsTo
    {
        return $this->belongsTo(AccountType::class);
    }
}
