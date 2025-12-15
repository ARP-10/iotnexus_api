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

    public $timestamps = false;


    /**
     * Relación: un cliente puede tener muchos equipos
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Relación: un cliente puede tener muchas máquinas
     */
    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}
