<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class SoftwareVersionController extends Controller
{
    public function latest(Request $request)
    {
        $serial = $request->get('serial_number');

        if (! $serial) {
            return response()->json(['message' => 'serial_number is required'], 400);
        }

        $machine = Machine::with('softwareVersion')
            ->where('serial_number', $serial)
            ->first();

        if (! $machine) {
            return response()->json(['message' => 'Machine not found'], 404);
        }

        if (! $machine->softwareVersion) {
            return response()->json(['message' => 'No version found'], 404);
        }

        $version = $machine->softwareVersion;

        return response()->json([
            'version'      => $version->version,
            'download_url' => $version->download_url,
            'mandatory'    => (bool) $version->mandatory,
            'changelog'    => $version->changelog,
        ]);
    }
}
