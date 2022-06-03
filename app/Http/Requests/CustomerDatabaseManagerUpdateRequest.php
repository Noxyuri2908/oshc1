<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDatabaseManagerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_of_customer_id'=>'nullable',
            'full_name'=>'nullable|string',
            'source_id'=>'nullable',
            'agent_id'=>'nullable',
            'english_center_id'=>'nullable',
            'event_id'=>'nullable',
            'identification'=>'nullable',
            'gender'=>'nullable',
            'date_of_birth'=>'nullable|date_format:d/m/Y',
            'mail'=>'nullable|email:rfc,dns',
            'phone_number'=>'nullable|numeric',
            'social_link'=>'nullable',
            'country_id'=>'nullable',
            'city_name'=>'nullable',
            'school_name'=>'nullable',
            'study_tour'=>'nullable',
            'departure_date'=>'nullable|date_format:d/m/Y',
            'destination_to_study'=>'nullable',
            'potentiality'=>'nullable',
            'potential_service'=>'nullable',
            'email_status'=>'nullable',
            'note'=>'nullable'
        ];
    }
}
