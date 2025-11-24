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
            'machine_id' => 'nullable|integer|exists:machines,id',
            'serial_number' => 'nullable|string',
            'app_version' => 'nullable|string|max:50',
        ]);

        // 1) Si recibimos machine_id, lo usamos directamente.
        if (!empty($validated['machine_id'])) {
            $machine = Machine::find($validated['machine_id']);
        }

        // 2) Si recibimos serial_number (y no machine_id), buscar o crear.
        if (empty($validated['machine_id']) && !empty($validated['serial_number'])) {

            $machine = Machine::where('serial_number', $validated['serial_number'])->first();

            // Si no existe → CREARLA con solo el serial
            if (!$machine) {
                $machine = Machine::create([
                    'serial_number' => $validated['serial_number'],
                    'product_id' => null,
                    'customer_id' => null,
                    'license_id' => null,
                ]);
            }
        }

        // 3) Validar que en efecto tenemos una machine
        if (!isset($machine)) {
            return response()->json([
                'error' => 'You must provide machine_id or serial_number'
            ], 400);
        }

        // 4) Crear la RUN asociada
        $run = Run::create([
            'machine_id' => $machine->id,
            'app_version' => $validated['app_version'] ?? 'unknown',
        ]);

        return response()->json([
            'message' => 'Run started successfully',
            'run_id' => $run->id,
            'machine_id' => $machine->id,
            'serial_number' => $machine->serial_number,
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
