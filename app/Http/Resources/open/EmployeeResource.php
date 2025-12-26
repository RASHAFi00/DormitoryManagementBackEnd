<?php

namespace App\Http\Resources\open;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            "firstName" => $this->first_name,
            "lastName" => $this->last_name,
            "age" => $this->age,
            "address" => $this->address,
            "mobile" => $this->mobile,
            "email" => $this->email,
            "specialization" => $this->specialization,
            "leaveDate" => $this->leave_date,

            // "unit" => UnitResource::make(Unit::find($this->unit_id)),
            "unit" => $this->unit ? UnitResource::make($this->load("unit")->unit->flatMap) : null,

            // "roles" => RoleResource::collection($this->role),
            "roles" => $this->role ? RoleResource::collection($this->load("role")->role) : null,

            "createdAt" => $this->created_at
        ];
    }
}
