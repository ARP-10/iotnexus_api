<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return Equipment::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|integer',
            'code' => 'required|string|unique:equipment,code',
            'name' => 'required|string',
        ]);

        $equipment = Equipment::create($validated);
        return response()->json($equipment, 201);
    }
}
