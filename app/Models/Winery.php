<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Winery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'id_responsable',
        'estado'
    ];

    public function users()
    {
        return $this->hasMany(user::class, 'id_responsable');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'id_bodega');
    }

    public function historyOrigen()
    {
        return $this->hasMany(History::class, 'id_bodega_origen');
    }

    public function historyDestino()
    {
        return $this->hasMany(History::class, 'id_bodega_destino');
    }
}
