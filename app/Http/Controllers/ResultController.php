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

    public function storeBulk(Request $request)
    {
        $request->validate([
            'run_id' => 'required|uuid|exists:runs,id',
            'results' => 'required|array',
            'results.*.metrics' => 'required|array',
            'results.*.timestamp' => 'nullable|string',
        ]);

        $bulk = [];
        foreach ($request->results as $r) {
            $bulk[] = [
                'run_id' => $request->run_id,
                'metrics' => $r['metrics'],
                'created_at' => $r['timestamp'] ?? now(),
            ];
        }
        Result::insert($bulk);

        return response()->json(['message' => 'Bulk results stored successfully'], 201);
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
