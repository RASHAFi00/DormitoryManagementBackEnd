<?php

namespace App\Http\Resources\open;

use App\Http\Resources\accountant\MaintenanceRequestResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Unit;
use App\Models\Room;

class MaintenanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $unit = Unit::find($this->unit_id);
        $room = Room::find($this->room_id);
        $unitManager = $unit->load("employee")->employee->filter(function($emp) {
            return $emp->load("roles")->roles->first()->name === "mentor";
        });
        $treasury = $this->load("treasury")->treasury;

        return [
            "id" => $this->id,
            "unit" => UnitResource::make($unit),
            "room" => RoomResource::make($room),
            "unitManager" => EmployeeResource::make($unitManager->first()),
            "treasury" => $treasury ? TreasuryResource::make($treasury) : null,
            "status" => $this->status,
            "totalCost" => $this->total_cost,
            "description" => $this->description,
            "startDate" => $this->start_date,
            "finishDate" => $this->finish_date,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at
        ];
    }
}
