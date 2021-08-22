<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'data' => parent::toArray($request),
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
