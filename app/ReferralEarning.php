<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralEarning extends Model
{
    //
    protected $fillable  = [
        'user_id', 'amount'
    ];
}
