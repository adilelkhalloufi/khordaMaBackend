<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'display' => $this->display,
            'parent_id' => $this->parent_id,
            'family_id' => $this->family_id,
            'family' => new FamiliesResource($this->family),
            'sub_categories' => CategoriesResource::collection($this->sub_categories),
        ];
    }
}
