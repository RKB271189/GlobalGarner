<?php

namespace App\Models\Rating;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    public $timestamps = false;

    public $fillable = [
        'clientip',
        'productid',
        'rate',
        'comment'
    ];
}
