<?php

namespace App\Models;

use App\Models\User;
use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'no_pr', 'no_po', 'date', 'req_date', 'note'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function PurchaseItem(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'purchase_id');
    }

    public function fpa(): HasMany
    {
        return $this->hasMany(Fpa::class);
    }
}
