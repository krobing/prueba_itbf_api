<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $fillable = [
        'nombre',
        'ciudad',
        'direccion',
        'nit',
        'capacidad_habitaciones',
    ];
    
    /**
     * Get the habitaciones for the hotel.
     */
    public function habitaciones(): HasMany
    {
        return $this->hasMany(Habitacion::class);
    }
}
