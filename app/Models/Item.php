<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $fillable = [
        'item_code',
        'item_name',
        'category_id',
        'sub_category',
        'unit',
        'note',
        'inv_non_inv'
    ];

    protected $table = 'items';

    public function Fpa()
    {
        return $this->hasMany(Fpa::class);
    }

    public function Purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function purchases()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function rel_parameter()
    {
        return $this->hasMany(RelParameter::class, 'item_id');
    }

    public function itemParameter()
    {
        return $this->hasMany(ItemParameter::class);
    }

    public function category_item()
    {
        return $this->belongsTo(CategoryItem::class, 'category_id');
    }
}
