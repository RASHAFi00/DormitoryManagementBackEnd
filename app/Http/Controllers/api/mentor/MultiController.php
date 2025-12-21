<?php

namespace App\Http\Controllers\api\mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Room;

use App\Http\Requests\mentor\MaintenanceRequestRequest;

class MultiController extends Controller
{
    public function setRoomState(Room $room , Request $request) {
        $validated = $request->validate([
            "state" => ["required" , Rule::in(["full" , "empty" , "under maintenance"])]
        ]);

        if(! $validated){
            return response()->json([
                "message" => "invalid state input"
            ] , 422);
        }

        $room->update([
            "state" => $validated["state"]
        ]);

        return response()->json([
            "message" => "room state updated successfully"
        ] , 200);
    }

    public function sendMaintenanceRequest(Room $room , MaintenanceRequestRequest $request) {

    }
}
