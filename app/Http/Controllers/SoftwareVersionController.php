<?php

namespace App\Http\Controllers;

use App\Models\SoftwareVersion;
use Illuminate\Http\Request;

class SoftwareVersionController extends Controller
{
    public function latest(Request $request)
    {
        $machineId = $request->get('machine_id');

        $query = SoftwareVersion::query();

        if ($machineId) {
            // solo versiones específicas para esa máquina
            $query->where('machine_id', $machineId);
        }
        
        $query = SoftwareVersion::where('app_name', $appName);

        if ($machineId) {
            $query->where('machine_id', $machineId);
        }

        $version = $query->orderByDesc('created_at')->first();

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
