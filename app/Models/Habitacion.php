<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Habitacion extends Model
{
    protected $fillable = [
        'hotel_id',
        'tipo',
        'acomodacion',
        'tipo_acomodacion_id',
    ];
    
    /**
     * Get the Hotel that owns the Habitacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the TipoAcomodacion associated with the Habitacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoAcomodacion(): HasOne
    {
        return $this->hasOne(TipoAcomodacion::class, 'id', 'tipo_acomodacion_id');
    }
}
