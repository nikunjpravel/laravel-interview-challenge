<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListsStoreRequest extends FormRequest
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
            'list_name' => 'required|string|max:255'
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'list_name.required' => 'List Name is required!',
            'list_name.string' => 'List Name must be valid string!',
            'list_name.max' => 'List Name must be :max chars!'
        ];
    }
}
