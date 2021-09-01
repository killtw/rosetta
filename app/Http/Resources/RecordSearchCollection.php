<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;

class RecordSearchCollection extends ResourceCollection
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
            'data' => $this->collection->transform(fn ($record) => [
                'from' => data_get($record, 'from'),
                'time' => Carbon::createFromTimestampUTC(data_get($record, 'time')),
            ]),
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
