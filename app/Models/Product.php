<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'name'
    ];

    public $timestamps = false;


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
