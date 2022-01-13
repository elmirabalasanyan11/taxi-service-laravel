<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birthday' => $this->birthday,
            'driver_license_number' => $this->driverLicense ? $this->driverLicense->number : '',
            'driver_license_series' => $this->driverLicense ? $this->driverLicense->series : '',
            'driver_license_expire_date' => $this->driverLicense ? $this->driverLicense->expire_date : '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
