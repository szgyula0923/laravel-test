<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'phone', 'email', 'name', 'message', 'website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
