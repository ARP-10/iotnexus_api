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
        $validated = $request->validate([
            'run_id' => 'required|exists:runs,id',
            'results' => 'required|array',
            'results.*.metrics' => 'required|array',
            'results.*.timestamp' => 'nullable|string',
        ]);

        $bulk = [];

        foreach ($validated['results'] as $r) {

            // Convertir timestamp a formato compatible
            $created = isset($r['timestamp'])
                ? date('Y-m-d H:i:s', strtotime($r['timestamp']))
                : now();

            $bulk[] = [
                'run_id'     => $validated['run_id'],
                'metrics'    => json_encode($r['metrics'], JSON_UNESCAPED_UNICODE),
                'created_at' => $created,
                'updated_at' => $created,
            ];
        }

        // Insert masivo
        Result::insert($bulk);

        return response()->json([
            'message' => 'Bulk results stored successfully',
            'saved'   => count($bulk)
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
