<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class UserPerson extends Model
{
    protected $table = 'user_person';

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
