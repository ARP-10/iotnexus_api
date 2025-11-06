<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_vat'
    ];

    /**
     * Relación: un cliente puede tener muchos productos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relación: un cliente puede tener muchas máquinas
     */
    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
