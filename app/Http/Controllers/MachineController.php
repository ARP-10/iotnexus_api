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
        ]);

        $machine = Machine::create($validated);
        return response()->json($machine, 201);
    }
}
