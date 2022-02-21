<?php

namespace App\Http\Resources;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Activitylog\Models\Activity;

class CandidateResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'position' => PositionResource::make($this->position),
            'status' => StatusResource::make($this->status),
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'linkedin_url' => $this->linkedin_url,
            'cv' => asset($this->cv)
        ];
    }
}
