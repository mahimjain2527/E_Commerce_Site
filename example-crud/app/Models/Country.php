<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $table = 'country';

    protected $fillable = ['country_name'];
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
