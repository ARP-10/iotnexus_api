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

}
