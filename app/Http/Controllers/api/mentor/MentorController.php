<?php

namespace App\Http\Controllers\api\mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Room;
use App\Models\MaintenanceRequest;
use App\Models\Fee;

use App\Http\Requests\mentor\MaintenanceRequestRequest;
use App\Http\Requests\mentor\FeeRequest;

class MentorController extends Controller
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

    public function sendMaintenanceRequest(MaintenanceRequestRequest $request) {
        MaintenanceRequest::query()->create($request->validated());

        return response()->json([
            "message" => "maintenance request sent succesfully"
        ] , 200);
    }

    public function sendFeeRequest(FeeRequest $request) {
        Fee::query()->create($request->validated());

        return response()->json([
            "message" => "fee request sent succesfully"
        ] , 200);
    }
}
