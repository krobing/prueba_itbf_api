<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelNotFoundException extends Exception
{
    public function __construct($message = 'Hotel no encontrado', $code = 404, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        // Aquí puedes agregar lógica para reportar el error (por ejemplo, enviar un correo, logearlo, etc.)
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => 'Hotel no encontrado',
            'message' => $this->getMessage()
        ], 404);
    }
}
