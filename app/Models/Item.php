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
        'category',
        'sub_category',
        'unit',
        'note',
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
        return $this->hasMany(PurchaseItem::class, 'item_id');
    }

    public function purchases()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function rel_parameter()
    {
        return $this->hasMany(RelParameter::class, 'item_id');
    }

    public function itemparameter()
    {
        return $this->hasMany(ItemParameter::class);
    }

    public function fpadetails()
    {
        return $this->hasMany(Fpa::class, 'item_id', 'item_name');
    }
}
