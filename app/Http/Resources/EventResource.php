<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'event_name' => $this->event_name,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'owner_id' => $this->owner_id,
            'max_num_of_participants' => $this->max_num_of_participants,
            'participants' => $this->participants->map(function ($participant) {
                return [
                    'id' => $participant->id,
                    'name' => $participant->name,
                    'email' => $participant->email,
                ];
            }),
        ];
    }
}
