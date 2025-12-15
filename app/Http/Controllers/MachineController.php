<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        return Machine::with('product')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|integer',
            'product_id' => 'required|exists:products,id',
            'serial_number' => 'required|string|unique:machines,serial_number',
            'license_id' => 'nullable|integer',
            'machine_version' => 'nullable|string|max:50',
        ]);

        $machine = Machine::create($validated);
        return response()->json($machine, 201);
    }

    public function findBySerial($serial)
    {
        $machine = Machine::where('serial_number', $serial)->first();

        if (!$machine) {
            return response()->json(['error' => 'Machine not found'], 404);
        }

        return response()->json([
            'machine_id' => $machine->id,
            'serial_number' => $machine->serial_number,
            'product_id' => $machine->product_id,
        ], 200);
    }

}
