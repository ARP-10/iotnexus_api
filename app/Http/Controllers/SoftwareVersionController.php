<?php

namespace App\Http\Controllers;

use App\Models\SoftwareVersion;
use Illuminate\Http\Request;

class SoftwareVersionController extends Controller
{
    public function latest(Request $request)
    {
        $serial = $request->get('serial_number');

        if (! $serial) {
            return response()->json(['message' => 'serial_number is required'], 400);
        }

        // Buscar versiones asociadas al serial
        $version = SoftwareVersion::where('serial_number', $serial)
            ->orderByDesc('created_at')
            ->first();

        if (! $version) {
            return response()->json(['message' => 'No version found'], 404);
        }

        return response()->json([
            'version'      => $version->version,
            'download_url' => $version->download_url,
            'mandatory'    => (bool) $version->mandatory,
            'changelog'    => $version->changelog,
        ]);
    }
}
