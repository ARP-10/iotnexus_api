<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Run;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Guarda un nuevo conjunto de métricas para una práctica
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'run_id' => 'required|exists:runs,id',
            'metrics' => 'required|array', // puede ser diccionario o lista
        ]);

        $result = Result::create([
            'run_id' => $validated['run_id'],
            'metrics' => $validated['metrics'],
        ]);

        return response()->json([
            'message' => 'Result saved successfully',
            'result' => $result
        ], 201);
    }

    /**
     * Devuelve los resultados de un run
     */
    public function show($run_id)
    {
        $results = Result::where('run_id', $run_id)->get();
        return response()->json($results);
    }
}
