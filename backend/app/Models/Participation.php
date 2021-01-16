<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = ['plan_id','user_id'];

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
