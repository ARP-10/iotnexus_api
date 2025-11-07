<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Run extends Model
{
    use HasFactory;

    public $incrementing = false;       
    protected $keyType = 'string';       
    protected $fillable = ['machine_id', 'app_version'];

    public $timestamps = false;


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
