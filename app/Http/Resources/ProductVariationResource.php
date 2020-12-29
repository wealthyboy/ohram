<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
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
          'image' => $this->image,
          'quantity' => $this->quantity,
          'price' => $this->price,
          'sale_price' => $this->sale_price,
          'images' => $this->images,
          'in_stock' => $this->stock(),
          'variation_values' => $this->product_variation_values
        ];
    }
}
