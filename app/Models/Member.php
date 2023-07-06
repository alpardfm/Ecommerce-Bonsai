<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
