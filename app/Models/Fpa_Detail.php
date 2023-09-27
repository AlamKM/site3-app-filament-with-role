<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusItem;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fpa_Detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Fpas';

    protected $casts = [
        'status_item' => StatusItem::class
    ];

    protected $fillable = ['fpa_id', 'parameter', 'std_parameter', 'unit', 'hasil_analisa', 'qc_analis', 'tgl_analisa', 'tgl_input'];

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
