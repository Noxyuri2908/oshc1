<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MarketFeedbackCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'agent_name' => $data->getAgentName(),
                    'processing_date' => convert_date_form_db($data->processing_date),
                    'issue' => $data->getIssue(),
                    'person_in_charge' => $data->getPersonName(),
                    'market_feedback' => $data->market_feedback
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
