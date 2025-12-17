<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        return Machine::with(['equipment', 'softwareVersion'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|integer',
            'equipment_id' => 'required|exists:equipment,id',
            'equipment_version' => 'required|string|max:20',
            'serial_number' => 'required|string|unique:machines,serial_number',
            'license_code' => 'nullable|integer',
            'software_version_id' => 'nullable|exists:software_versions,id',
        ]);

        $machine = Machine::create($validated);

        return response()->json($machine, 201);
    }

    public function findBySerial($serial)
    {
        $machine = Machine::with(['equipment', 'softwareVersion'])
            ->where('serial_number', $serial)
            ->first();

        if (!$machine) {
            return response()->json(['error' => 'Machine not found'], 404);
        }

        return response()->json([
            'machine_id' => $machine->id,
            'serial_number' => $machine->serial_number,
            'equipment_id' => $machine->equipment_id,
            'equipment_version' => $machine->equipment_version,
            'software_version_id' => $machine->software_version_id,
            'software' => $machine->softwareVersion ? [
                'app_name' => $machine->softwareVersion->app_name,
                'version' => $machine->softwareVersion->version,
            ] : null,
        ], 200);
    }

    public function storeLicense(Request $request, $serial)
    {
        $validated = $request->validate([
            'license_code' => 'required|string|max:255',
        ]);

        $machine = Machine::where('serial_number', $serial)->first();

        // 1️⃣ No existe el número de serie
        if (!$machine) {
            return response()->json([
                'error' => 'Machine not found'
            ], 404);
        }

        // 2️⃣ Ya tiene licencia
        if (!empty($machine->license_code)) {
            return response()->json([
                'error' => 'License already generated for this machine',
                'license_code' => $machine->license_code,
            ], 409);
        }

        // 3️⃣ Guardar licencia
        $machine->license_code = $validated['license_code'];
        $machine->save();

        return response()->json([
            'message' => 'License stored successfully',
            'serial_number' => $machine->serial_number,
            'license_code' => $machine->license_code,
        ], 200);
    }

}
