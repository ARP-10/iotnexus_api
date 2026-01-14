<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'equipment_id', 'serial_number', 'equipment_version', 'software_version_id'];


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
        return $this->belongsTo(\App\Models\SoftwareVersion::class, 'software_version_id');
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }
}