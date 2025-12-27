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
        $unit = $this->whenLoaded("unit" , null , "N/A");
        $roles = $this->whenLoaded("roles" , null , "N/A");

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

            "unit" => $unit ? UnitResource::make($unit) : null,

            "roles" => $roles ? RoleResource::collection($roles) : null,

            "createdAt" => $this->created_at
        ];
    }
}
