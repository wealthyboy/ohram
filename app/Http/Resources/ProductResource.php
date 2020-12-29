<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductAttributeResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductVariationResource;

class ProductResource extends JsonResource
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
            'product_name' => $this->product_name,
            'converted_price' => $this->converted_price,
            'discount_price' => $this->discount_price,
            'brand' => optional($this->brand)->name,
            'currency' => $this->currency,
            'quantity' => $this->quantity,
            'image' => $this->image,
            'description' => $this->description,
            'default_variation_id' => optional($this->default_variation)->id,
            'sku' =>$this->sku,
            'related_products' =>$this->related_products,
            'inventory' => $this->product_inventory(),
            'stock' => $this->product_stock(),
            'attributes' =>ProductAttributeResource::collection(
                $this->parent_attributes  
            ),
        ];
    }
}
