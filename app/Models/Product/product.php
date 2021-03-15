<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $timestamps = false;

    protected $table = 'product';

    protected $fillable = [
        'productname',
        'vendor',
        'description',
        'image',
        'quantity',
        'discount',
        'price',
        'isavailable',
        'createdate'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor', 'id');
    }
}
