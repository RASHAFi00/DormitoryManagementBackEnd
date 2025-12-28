<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Employee;

use App\Http\Resources\open\EmployeeResource;

class MaintenanceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "unitId" => $this->unit_id,
            "unitName" => $this->unit_name,
            "roomId" => $this->room_id,
            "unitManager" => $this->unit_manager ? EmployeeResource::make(Employee::find($this->unit_manager)) : null,
            "agreed" => $this->agreed,
            "description" => $this->description
        ];
    }
}
