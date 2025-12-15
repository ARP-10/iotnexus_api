<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareVersion extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'serial_number',
        'machine_version',
        'app_name',
        'version',
        'download_url',
        'changelog',
        'mandatory',
    ];
}
