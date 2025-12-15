<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'equipment_id', 'license_id', 'serial_number', 'equipment_version', 'software_version_id'];


    public $timestamps = false;

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function runs()
    {
        return $this->hasMany(Run::class);
    }

    public function softwareVersion()
    {
        return $this->belongsTo(SoftwareVersion::class);
    }


}