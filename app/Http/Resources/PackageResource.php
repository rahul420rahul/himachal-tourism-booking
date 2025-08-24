<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'max_participants' => $this->max_participants,
            'is_active' => $this->is_active,
            'featured' => $this->featured,
        ];
    }
}
