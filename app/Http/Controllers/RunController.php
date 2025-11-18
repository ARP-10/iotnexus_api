<?php

namespace App\Http\Controllers;

use App\Models\Run;
use App\Models\Machine;
use Illuminate\Http\Request;

class RunController extends Controller
{
    /**
     * Inicia una nueva práctica (run)
     */
    public function start(Request $request)
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'app_version' => 'nullable|string|max:50',
        ]);

        $run = Run::create([
            'machine_id' => $validated['machine_id'],
            'app_version' => $validated['app_version'] ?? 'unknown',
        ]);

        return response()->json([
            'message' => 'Run started successfully',
            'run_id' => $run->id,
        ], 201);
    }

    /**
     * Cierra la práctica (se podría usar más adelante)
     */
    public function end($id)
    {
        $run = Run::findOrFail($id);
        $run->update(['ended_at' => now()]);

        return response()->json(['message' => 'Run ended', 'run' => $run]);
    }

    /**
     * Devuelve todas las prácticas registradas
     */
    public function index()
    {
        return Run::with('machine')->latest()->get();
    }

    public function destroy($id)
{
    $run = Run::findOrFail($id);

    // Si hay results asociados, impedir borrado (opcional)
    if ($run->results()->count() > 0) {
        return response()->json(['error' => 'Run has results, cannot delete'], 400);
    }

    $run->delete();

    return response()->json(['message' => 'Run deleted']);
}

}
