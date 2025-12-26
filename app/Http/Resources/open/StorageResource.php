<?php

namespace App\Http\Resources\open;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StorageResource extends JsonResource
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
            "itemName" => $this->item_name,
            "quantity" => $this->quantity,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at
        ];
    }
}
