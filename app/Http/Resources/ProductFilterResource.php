<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\CategoryAttributeResource;

class ProductFilterResource extends JsonResource
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
          'id' =>$this->id,
          'name' => $this->name,
          'children' => $this->children,
          'attributes' => CategoryAttributeResource::collection($this->parent_attributes)
        ];
    }
}
