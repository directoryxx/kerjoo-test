<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $fillable = [
        'user_id',
        'reason',
        'submission_date'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
