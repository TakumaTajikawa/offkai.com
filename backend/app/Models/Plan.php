<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTO;

class Plan extends Model
{
    public function user():BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
