<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareVersion extends Model
{
    const UPDATED_AT = null;
    protected $fillable = [
        'machine_id', 
        'app_name',
        'version',
        'download_url',
        'changelog',
        'mandatory',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
