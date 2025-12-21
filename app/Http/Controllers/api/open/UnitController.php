<?php

namespace App\Http\Controllers\api\open;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Unit;

use App\Http\Resources\open\UnitResource;
use App\Http\Resources\open\UnitRoomResource;
use App\Http\Resources\open\UnitStorageResource;

class UnitController extends Controller
{
    public function getUnitData() {
        return UnitResource::collection(Unit::all());
    }

    public function getUnitStorage(Unit $unit) {
        return UnitStorageResource::collection($unit->with("storage"));
    }

    public function getUnitRooms(Unit $unit) {
        return UnitRoomResource::collection($unit->with("room"));
    }

}
