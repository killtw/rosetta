<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class MerchantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => Str::padLeft($this->id, 15, 0),
                'name' => $this->name,
                'location' => $this->location,
            ],
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return string[]
     */
    public function with($request): array
    {
        return [
            'message' => 'success',
        ];
    }
}
