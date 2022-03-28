<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitCount extends Model
{
    //
    protected $fillable = [
        'user_id',
        'visit_counts',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
