<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Exceptions\HotelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::with('habitaciones')->get();
        
        return HotelResource::collection($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|unique:hotels',
                'ciudad' => 'required',
                'direccion' => 'required',
                'nit' => 'required|unique:hotels',
                'capacidad_habitaciones' => 'required|integer|max:42',
            ]);
    
            $hotel = Hotel::create($validatedData);
        
            return response()->json(new HotelResource($hotel), 201);

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
        $hotel = Hotel::with(['habitaciones'])->find($id);

        if (!$hotel) {
            throw new HotelNotFoundException('El Hotel con ID ' . $id . ' no se encuentra.');
        }

        return new HotelResource($hotel);
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
