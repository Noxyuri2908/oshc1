<?php

namespace App\Http\Requests;

use App\Admin\MediaPost;
use Illuminate\Foundation\Http\FormRequest;

class TaskMediaStatusUpdateRequest extends FormRequest
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
        $arrayStatus = collect(array_keys(MediaPost::$TYPE))->implode(',');
        return [
            'type'=>'required|in:'.$arrayStatus,
            'name'=>'required|string',
            'category'=>'nullable',
            'category.*'=>'required'
        ];
    }
}
