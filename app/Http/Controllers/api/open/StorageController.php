<?php

namespace App\Http\Controllers\api\open;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Unit;
use App\Models\Storage;

use App\Http\Resources\open\StorageResource;
use App\Http\Resources\open\UnitResource;

class StorageController extends Controller
{
    public function getUnitStorageData(Request $request) {
        $unit = $request->user("employee")->load("unit")->unit->flatMap;
        $storage = $unit->load("storage")->storage;
        // return StorageResource::collection($storage);
        return response()->json([
            "unit" => UnitResource::make($unit),
            "storage" => StorageResource::collection($storage)
        ]);
    }

    public function getUnitStorageDataGlobal(Request $request) {
        $validated = $request->validate([
            "unitId" => ["required" , "numeric" , Rule::exists("units" , "id")]
        ]);

        if(! $validated){
            return response()->json([
                "message" => "unit not found"
            ] , 404);
        }

        $unit = Unit::find($validated["unitId"]);
        $storage = $unit->load("storage")->storage;

        // return StorageResource::collection(Storage::where("unit_id" , $validated["unitId"]));
        return response()->json([
            "unit" => UnitResource::make(Unit::find($validated["unitId"])),
            "storage" => StorageResource::collection($storage)
        ]);
    }
}
