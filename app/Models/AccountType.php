<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    public function marketInformation():hasMany
    {
        return $this->hasMany(marketInformation::class);
    }
}
