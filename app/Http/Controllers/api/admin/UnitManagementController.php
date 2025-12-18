<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Unit;

use App\Http\Requests\admin\UnitCapRequest;

use App\Http\Resources\admin\units\UnitResource;
use App\Http\Resources\admin\units\UnitRoomResource;
use App\Http\Resources\admin\units\UnitStorageResource;



class UnitManagementController extends Controller
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

    public function setUnitRoomCap(Unit $unit , Request $request) {
        $validated = $request->validate([
            "roomCap" => ["required" , "numeric" , "min:1"]
        ]);

        if(! $validated){
            return response()->json([
                "message" => "invalid room cap input"
            ] , 422);
        }

        $unit->update(["room_cap" => $validated["roomCap"]]);
        return response()->json([
            "message" => "room cap updated successfully"
        ] , 200);
    }

    public function setUnitGender(Unit $unit , Request $request) {
        $validated = $request->validate([
            "gender" => ["required" , "string" , "in:males,females"]
        ]);

        if(! $validated){
            return response()->json([
                "message" => "invalid gender input"
            ]);
        }

        $unit->update(["gender" => $validated["gender"]]);
    }
}
