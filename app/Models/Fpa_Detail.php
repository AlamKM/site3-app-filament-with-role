<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fpa_Detail extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'category_id', 'fpa_id', 'relasiparameter_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function category_item()
    {
        return $this->belongsTo(CategoryItem::class);
    }

    public function fpa()
    {
        return $this->belongsTo(Fpa::class);
    }
}
