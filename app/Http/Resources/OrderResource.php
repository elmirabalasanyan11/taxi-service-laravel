<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from_address' => $this->from_address,
            'to_address' => $this->to_address,
            'from_coordinate_x' => $this->from_coordinate_x,
            'from_coordinate_y' => $this->from_coordinate_y,
            'to_coordinate_x' => $this->to_coordinate_x,
            'to_coordinate_y' => $this->to_coordinate_y,
            'min_cost' => $this->min_cost,
            'cost_by_km' => $this->cost_by_km,
            'cost_by_minutes' => $this->cost_by_minutes,
            'final_cost' => $this->final_cost,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
