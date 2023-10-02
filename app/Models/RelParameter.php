<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelParameter extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'item_id',
        'parameter_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function ItemParameter()
    {
        return $this->hasMany(ItemParameter::class);
    }

    public function parameters()
    {
        return $this->hasMany(Parameter::class, 'parameter_id');
    }
}
