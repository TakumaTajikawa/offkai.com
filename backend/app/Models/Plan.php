<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTO;

class Plan extends Model
{

    protected $fillable = [
        'title',
        'body',
        'prefecture',
        'cities',
        'genre',
        'meeting_date_time',
        'image',
        'age',
        'venue',
        'membership_fee'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
