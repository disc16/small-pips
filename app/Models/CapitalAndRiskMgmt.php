<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CapitalAndRiskMgmt extends Model
{
    protected $casts = [
        'targets' => 'array'
    ];


    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setTargetsAttribute($value)
{
        $targets = [];

        // foreach ($value as $array_item) {
        //     if (!is_null($array_item['key'])) {
        //         $targets[] = $array_item;
        //     }
        // }

        $this->attributes['targets'] = json_encode($value);
    }
}
