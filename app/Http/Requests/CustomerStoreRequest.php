<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'agent_id' => 'required|numeric|exists:users,id',
            'master_agent' => 'nullable|numeric|exists:users,id',
            'service_country' => 'required',
            'type_service' => 'required|numeric|exists:dichvus,id',
            'type_invoice' => 'required|numeric',
            'provider_id' => 'required|numeric|exists:services,id',
            "policy" => 'required|numeric',
            "no_of_adults" => 'required|numeric|in:1,2',
            "no_of_children" => 'required|numeric|in:0,1,2,3,4,5',
            "type_visa" => 'required|numeric',
            "start_date" => 'required|date_format:d/m/Y',
            "end_date" => 'required|date_format:d/m/Y',
//            "net_amount" => 'required|min:0|not_in:0',
            "status" => 'required',
            "note" => 'nullable',
            "staff_id" => 'required|exists:admins,id',
            "prefix_name" => 'required',
            "first_name" => 'required',
            "last_name" => 'required',
            "gender" => 'required',
            "birth_of_date" => 'nullable|date_format:d/m/Y',
            "passport" => "nullable",
            "country" => "nullable",
            "email" => "nullable",
            "place_study" => "nullable",
            "student_id" => "nullable",
            "phone" => "nullable",
            "fb" => "nullable",
//            "location_australia" => "required",`
            "promotion_id" => "nullable",
            "promotion_amount" => "nullable",
            "bank_fee" => "nullable",
            "bank_fee_number" => "nullable",
            "payment_method" => "nullable",
            "gst" => "nullable",
            "surcharge" => "nullable",
            "extra" => "nullable",
            "comm" => "nullable",
//            "total" => "nullable|min:0|not_in:0",
            "destination"=>"nullable",
            "provider_of_school"=>"nullable",
            "count_month"=>"nullable|numeric",
            "count_day"=>"nullable|numeric"
        ];
    }
}
