<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category'];

    public function Fpa()
    {
        return $this->hasMany(Fpa::class);
    }

    public function Fpa_Detail()
    {
        return $this->hasMany(Fpa_Detail::class);
    }

    public function Item()
    {
        return $this->hasMany(Item::class);
    }
}
