<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post_type' => ['required', 'numeric', 'digits_between:0,2'],
            'name' => ['required', 'max:255'],
            'headline' => ['max:255'],
            'text' => ['max:5000'],
            'location' => ['max:255'],
            'picture' => ['max:255']
        ];
    }
}
