<?php

namespace App\Http\Controllers\api\open;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Unit;

use App\Http\Resources\open\UnitResource;
use App\Http\Resources\open\RoomResource;
use App\Http\Resources\open\StorageResource;

class UnitController extends Controller
{
    public function getUnitData() {
        return UnitResource::collection(Unit::all());
    }

    public function getUnitStorage(Unit $unit) {
        return response()->json([
            "unit" => UnitResource::make($unit),
            "storage" => StorageResource::collection($unit->load("storage")->storage)
        ]);
    }

    public function getUnitRooms(Unit $unit) {
        return RoomResource::collection($unit->room);
    }

}
