<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class LocationResource extends JsonResource
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
           'id' => $this->id,
           'name' => $this->name,
           'states' => $this->children()->orderBy('name','ASC')->get()
        ];
    }
}
