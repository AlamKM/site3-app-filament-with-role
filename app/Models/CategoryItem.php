<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['category'];

    public function Fpa()
    {
        return $this->hasMany(Fpa::class);
    }

    public function Fpa_Detail()
    {
        return $this->hasMany(Fpa_Detail::class);
    }
}
