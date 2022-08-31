<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
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
            'election_id' => $this->election_id,
            // 'voter_id' => $this->voter_id,
            'candidate_name' => $this->detail->name,
            'section_id' => $this->section_id,
            'section_name' => $this->section->name,
            'motto' => $this->motto,
            'candidate_image' => url('storage/candidate/' . $this->candidate_image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
