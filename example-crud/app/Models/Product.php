<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\Auth;



class Product extends Model
{
  
    protected $fillable = ['name', 'detail','image','price','user_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

    // /**
    //  * Determine if the logged-in user is an admin.
    //  */
    // public static function isAdmin(): bool
    // {
    //     return Auth::check() && Auth::user()->role === 'admin';
    // }

    // /**
    //  * Get the products based on the user's role.
    //  */
    // public static function getProducts(): \Illuminate\Database\Eloquent\Builder
    // {
    //     return static::isAdmin() ? static::latest() : static::where('user_id', Auth::id())->latest();
    // }
}


