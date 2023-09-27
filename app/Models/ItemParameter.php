<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemParameter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'parameter_id',
        'std_nilai',
        'note'
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
