<?php

namespace App\Http\Resources;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimelineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'properties' => [
                'old' => StatusResource::make(
                    Status::find($this->properties['old']['status_id'])
                ),
                'new' => StatusResource::make(
                    Status::find($this->properties['attributes']['status_id'])
                )
            ],
            'comment' => $this->description
        ];
    }
}
