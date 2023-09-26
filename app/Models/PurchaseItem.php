<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['purchase_id', 'item_id', 'quantity', 'notes', 'no_pr', 'no_po', 'date', 'req_date', 'note'];

    protected $table = 'purchase_items';

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
