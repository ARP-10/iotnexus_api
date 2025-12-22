<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model
{
    public $timestamps = false;
    protected $table = 'licenses';

    protected $fillable = [
        'machine_id',
        'license_code',
        'valid_from',
        'valid_until',
        'lic_storage_path',
        'status',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }
}
