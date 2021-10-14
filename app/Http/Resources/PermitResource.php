<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "submission_date" => $this->submission_date,
            "reason" => $this->reason,
            "user" => $this->whenLoaded('user'),
        ];
    }
}
