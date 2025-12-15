<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'product_id', 'license_id', 'serial_number', 'machine_version'];


    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function runs()
    {
        return $this->hasMany(Run::class);
    }

}