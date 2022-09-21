<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cantidad',
        'id_bodega_origen',
        'id_bodega_destino',
        'id_inventario'
    ];


    public function winteryOrigen()
    {
        return $this->belongsTo(Winery::class);
    }

    public function winteryDestino()
    {
        return $this->belongsTo(Winery::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}

