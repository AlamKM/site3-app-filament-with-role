<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'parameter_id',
    ];

    protected $table = 'item_parameters';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function relparameter()
    {
        return $this->belongsTo(RelParameter::class);
    }
}
