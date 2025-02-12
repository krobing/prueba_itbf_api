<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        $toReturnArray = [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "ciudad" => $this->ciudad,
            "direccion" => $this->direccion,
            "nit" => $this->nit,
            "capacidad_habitaciones" => $this->capacidad_habitaciones,
            "cantidad_habitaciones" => $this->habitaciones->count(),
        ];

        // Agrupamos y contamos las habitaciones solo si estamos en el método `show`
        if ($request->route()->getName() === 'hoteles.show') {
            $groupedRooms = $this->habitaciones->groupBy(function ($room) {
                return Str::lower($room->tipo . '_' . $room->acomodacion);
            })->map(function ($rooms, $key) {
                return [
                    'tipo_acomodacion' => $key,
                    'count' => $rooms->count(),
                ];
            });

            $toReturnArray["grouped_rooms"] = $groupedRooms;
        }
        
        return $toReturnArray;
    }
}
