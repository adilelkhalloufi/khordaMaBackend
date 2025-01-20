<?php

namespace App\Http\Resources;

use App\enum\ProductStatue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'categorie' => $this->categorie,
            'unite' => $this->unite,
            'status' => ProductStatue::from($this->status)->getLabel(),
            'image' => $this->image,
            'created_at' => $this->created_at,
        ];
    }
}
