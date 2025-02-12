<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register()
    {
        $this->renderable(function (ValidationException $e, $request) {
            return response()->json(['errors' => $e->errors()], 422);
        });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        });

        $this->renderable(function (Throwable $e, $request) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        });
    }
}
