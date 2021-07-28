<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpStoreRequest extends FormRequest
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
            //
            'agent_id'=>'nullable',
            'process_date'=>'required',
            'status'=>'required|numeric',
            'contact_by'=>'nullable',
            'des'=>'nullable',
            'person_in_charge'=>'required',
            'submit_from'=>'nullable',
            'user_id'=>'nullable',
            'create_person'=>'nullable',
            'assigned_person'=>'nullable',
            'follow_up_status'=>'nullable',
            'hot_issue'=>'nullable',
            'due_date'=>'nullable',
            'estimate'=>'nullable',
            'title_task'=>'nullable',
            'task_description'=>'nullable',
            'comment' => 'nullable',
            'send_to_staff_id' => 'nullable',
            'date_comment' => 'nullable',
            'staff_create_cm' => 'nullable'
        ];
    }
}
