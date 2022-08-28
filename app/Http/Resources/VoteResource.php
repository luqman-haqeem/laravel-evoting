<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'election_id' => $this->election_id,
            'candidate_id' => $this->candidate_id,
            'total_votes' => $this->total_votes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
