<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeProductResource extends JsonResource
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
            'product_id' => $this->product_id,
            'name' => $this->product->name,
            'brand' => $this->attribute->type,
            'category' => $this->product->category,
            'size' => $this->size,
            'unit' => $this->product->pku,
            'image' => $this->product->image,
            'description' => $this->product->description,
            'purchase_price' => $this->purchase_price,
            "price" => $this->price,
            'amount' => $this->amount,
            'discount' => $this->product->discount,
            'discount_start' => $this->product->discount_start,
            'discount_end' => $this->product->discount_end,
            'stock' => $this->available_stock,
            'discontinued' => $this->product->discontinued,
            "added_by" => $this->user->first_name . ' ' . $this->user->last_name,
            "updated_by" => $this->updated_by,
            'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),

        ];
    }
}