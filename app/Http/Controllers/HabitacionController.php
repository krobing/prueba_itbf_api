<?php

namespace App\Http\Controllers;

use App\Exceptions\HotelNotFoundException;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;
use App\Http\Resources\HabitacionResource;
use App\Models\Hotel;
use App\Models\Habitacion;
use App\Models\TipoAcomodacion;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hotelId = $request->query('hotel_id');

        $hotel = Hotel::find($hotelId);
        if (!$hotel) {
            throw new HotelNotFoundException('El Hotel con ID ' . $hotelId . ' no se encuentra.');
        }

        $habitaciones = Habitacion::whereBelongsTo($hotel)->get();

        return HabitacionResource::collection($habitaciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $hotel = Hotel::findOrFail($request->hotel_id);
            $TipoAcomodacion = TipoAcomodacion::findOrFail($request->tipo_acomodacion_id);
            
            $totalHabitaciones = $hotel->habitaciones()->count();
            if ($totalHabitaciones >= $hotel->capacidad_habitaciones) {
                return response()->json(['error' => 'El hotel ha alcanzado su capacidad máxima de habitaciones.'], 400);
            }

            $validatedData = $request->validate([
                'hotel_id' => 'required|exists:hotels,id',
                'tipo_acomodacion_id' => 'required|exists:tipo_acomodacions,id',
            ]);

            $validatedData = $request->merge([
                'tipo' => $TipoAcomodacion->tipo,
                'acomodacion' => $TipoAcomodacion->acomodacion,
            ])->all();

            $habitacion = Habitacion::create($validatedData);

            return response()->json(new HabitacionResource($habitacion), 201);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $habitacion = Habitacion::with('hotel')->findOrFail($id);

        return new HabitacionResource($habitacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
