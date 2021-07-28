<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FollowUpsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'process_date' => convert_date_form_db($data->process_date),
                    'status' => $data->getStatus(),
                    'rating' => $data->rating,
                    'agent_name' => $data->getAgentName(),
                    'contact_by' => $data->getContact(),
                    'des' => $data->des,
                    'person_in_charge' => $data->getPersonName(),
                    'potential_service' => $data->getPotentialService()
                ];
            }),
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ],
        ];
    }
}
