<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
    ];

    // Define the relationship with the User model (customer)
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

