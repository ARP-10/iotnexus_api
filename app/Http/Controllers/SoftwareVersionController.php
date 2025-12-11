<?php

namespace App\Http\Controllers;

use App\Models\SoftwareVersion;
use Illuminate\Http\Request;

class SoftwareVersionController extends Controller
{
    public function latest(Request $request)
    {
        $machineId = $request->get('machine_id');
        $appName = $request->get('app_name', 'IT032_PC');

        $query = SoftwareVersion::where('app_name', $appName);

        if ($machineId) {
            $query->where('machine_id', $machineId);
        }

        $latest = $query->orderBy('created_at', 'desc')->first();

        if (!$latest) {
            return response()->json(['message' => 'No version found'], 404);
        }

        return response()->json([
            'id' => $latest->id,
            'machine_id' => $latest->machine_id,
            'app_name' => $latest->app_name,
            'version' => $latest->version,
            'download_url' => $latest->download_url,
            'changelog' => $latest->changelog,
            'mandatory' => (bool) $latest->mandatory,
            'created_at' => $latest->created_at,
        ]);
    }

}
