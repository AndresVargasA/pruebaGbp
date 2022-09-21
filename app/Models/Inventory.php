<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_bodega',
        'id_producto',
        'cantidad'
    ];


    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function histories()
    {
        return $this->hasMany(Inventory::class, 'id_inventory');
    }
}
