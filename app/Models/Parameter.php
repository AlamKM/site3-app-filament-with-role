<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parameter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parameter',
        'unit',
        'metode',
        'note',
    ];

    public function Fpa()
    {
        return $this->hasMany(Fpa::class);
    }

    public function rel_parameter(): HasMany
    {
        return $this->hasMany(RelParameter::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function itemParameters()
    {
        return $this->hasMany(ItemParameter::class, 'parameter_id');
    }

    public function unitparameter()
    {
        return $this->hasMany(Parameter::class);
    }
}
