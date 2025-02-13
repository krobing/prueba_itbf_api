<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\TipoAcomodacion;
class TipoAcomodacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tipos_acomodaciones = TipoAcomodacion::all('id', 'tipo', 'acomodacion')
                                ->groupBy('tipo');
        
        return response()->json($tipos_acomodaciones);
    }
}
