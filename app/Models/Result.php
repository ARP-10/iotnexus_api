<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'metrics',
    ];

    protected $casts = [
        'metrics' => 'array', 
    ];

    public function run()
    {
        return $this->belongsTo(Run::class);
    }
}
