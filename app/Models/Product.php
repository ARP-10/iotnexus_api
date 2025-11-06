<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'code',
        'name'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
