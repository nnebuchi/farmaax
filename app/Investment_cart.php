<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment_cart extends Model
{
    public $table = 'investment_cart';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
