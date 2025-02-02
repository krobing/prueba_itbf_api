<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
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
        $validatedData = $request->validate([
            'nombre' => 'required|unique:hotels',
            'ciudad' => 'required',
            'direccion' => 'required',
            'nit' => 'required|unique:hotels',
            'capacidad_habitaciones' => 'required|integer|max:42',
        ]);
    
        $hotel = Hotel::create($validatedData);
    
        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return response()->json($hotel->load('habitaciones'));
        $hotel = Hotel::with('habitaciones')->findOrFail($id);
        return response()->json($hotel);
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
