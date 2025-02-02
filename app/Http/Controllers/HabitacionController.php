<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  /*       $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'tipo' => 'required|in:Estándar,Junior,Suite',
            'acomodacion' => 'required|in:Sencilla,Doble,Triple,Cuádruple',
        ]);
    
        $habitacion = Habitacion::create($validatedData);
    
        return response()->json($habitacion, 201); */


        $hotel = Hotel::findOrFail($request->hotel_id);
    
        if ($hotel->capacidad_habitaciones >= 42) {
            return response()->json(['error' => 'El hotel ha alcanzado su capacidad máxima de habitaciones.'], 400);
        }

        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'tipo' => 'required|in:Estandar,Junior,Suite',
            'acomodacion' => 'required|in:Sencilla,Doble,Triple,Cuádruple',
        ]);

        // Lógica para asignar tipos de acomodación
        $tipo_acomodacion = [
            'Estandar' => ['Sencilla', 'Doble'],
            'Junior' => ['Triple', 'Cuadruple'],
            'Suite' => ['Sencilla', 'Doble', 'Triple'],
        ];

        if (!in_array($validatedData['acomodacion'], $tipo_acomodacion[$validatedData['tipo']])) {
            return response()->json(['error' => 'Acomodación no permitida para el tipo de habitación especificado.'], 400);
        }

        $habitacion = Habitacion::create($validatedData);
        // $hotel->capacidad_habitaciones++;
        // $hotel->save();

        return response()->json($habitacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $habitacion = Habitacion::with('tipoAcomodaciones')->findOrFail($id);
        return response()->json($habitacion);
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
