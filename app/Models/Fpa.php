<?php

namespace App\Models;

use App\Enums\StatusItem;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fpa extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $fillable = [
        'item_id',
        'purchase_id',
        'category_item_id',
        'no_fpa',
        'no_lot',
        'status_item',
        'qcanalis_by',
        'status_fpa',
        'note'
    ];

    protected $casts = [
        'status_item' => StatusItem::class
    ];

    //protected $table = 'Fpa_Details';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function category_item()
    {
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function rel_parameter()
    {
        return $this->hasMany(RelParameter::class);
    }

    public function fpa_details()
    {
        return $this->hasMany(RelParameter::class);
    }
}
