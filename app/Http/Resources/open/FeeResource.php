<?php

namespace App\Http\Resources\open;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Student;
use App\Models\Treasury;

class FeeResource extends JsonResource
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
            "student" => StudentResource::make($this->load("student")->student),
            "treasury" => TreasuryResource::make($this->load("treasury")->treasury),
            "type" => $this->type,
            "cost" => $this->cost,
            "processNumber" => $this->process_number,
            "paid" => $this->paid
        ];
    }
}
