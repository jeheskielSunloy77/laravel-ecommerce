<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image', 'category'];
    protected $primaryKey = 'id';
    protected $keyType = 'string'; // This is important to indicate the type of the primary key

    public $incrementing = false; // This is important to indicate that the ID is not auto-incrementing
    public $timestamps = true;

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
