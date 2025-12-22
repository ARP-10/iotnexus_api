<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Machine;

class LicenseController extends Controller
{
    public function index(Request $request)
    {
        return License::with('machine')
            ->orderByDesc('id')
            ->paginate(25);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'machine_id' => ['required', 'integer', 'exists:machines,id'],
            'license_code' => ['required', 'string', 'max:255'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'lic_storage_path' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', Rule::in(['active', 'expired', 'revoked'])],
        ]);

        $license = License::create([
            'machine_id' => $data['machine_id'],
            'license_code' => $data['license_code'],
            'valid_from' => $data['valid_from'] ?? null,
            'valid_until' => $data['valid_until'] ?? null,
            'lic_storage_path' => $data['lic_storage_path'] ?? null,
            'status' => $data['status'] ?? 'active',
        ]);

        return response()->json($license->load('machine'), 201);
    }

    public function show(License $license)
    {
        return $license->load('machine');
    }

    public function update(Request $request, License $license)
    {
        $data = $request->validate([
            'machine_id' => ['sometimes', 'integer', 'exists:machines,id'],
            'license_code' => ['sometimes', 'string', 'max:255'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'lic_storage_path' => ['nullable', 'string', 'max:500'],
            'status' => ['sometimes', Rule::in(['active', 'expired', 'revoked'])],
        ]);

        $license->update($data);

        return $license->load('machine');
    }

    public function destroy(License $license)
    {
        $license->delete();
        return response()->noContent();
    }

    public function storeBySerial(Request $request, string $serial)
    {
        $machine = Machine::where('serial_number', $serial)->first();

        if (!$machine) {
            return response()->json(['message' => 'Machine not found'], 404);
        }

        $data = $request->validate([
            'license_code' => ['required', 'string', 'max:255'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'lic_storage_path' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', Rule::in(['active', 'expired', 'revoked'])],
        ]);

        $license = License::create([
            'machine_id' => $machine->id,
            'license_code' => $data['license_code'],
            'valid_from' => $data['valid_from'] ?? null,
            'valid_until' => $data['valid_until'] ?? null,
            'lic_storage_path' => $data['lic_storage_path'] ?? null,
            'status' => $data['status'] ?? 'active',
        ]);

        // IMPORTANTE: NO hay 409. Siempre crea un registro nuevo.
        return response()->json($license->load('machine'), 201);
    }
}
