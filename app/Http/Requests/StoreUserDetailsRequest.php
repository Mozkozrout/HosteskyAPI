<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserDetailsRequest extends FormRequest
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
            'height' => ['numeric', 'digits_between:0,250'],
            'chest_size' => ['numeric', 'digits_between:0,250'],
            'waist_size' => ['numeric', 'digits_between:0,250'],
            'hips_size' => ['numeric', 'digits_between:0,250'],
            'english' => ['numeric', 'digits_between:0,1'],
            'german' => ['numeric', 'digits_between:0,1'],
            'french' => ['numeric', 'digits_between:0,1'],
            'another_lang' => ['string', 'max:255'],
            'catering_exp' => ['numeric', 'digits_between:0,1'],
            'modelling_exp' => ['numeric', 'digits_between:0,1'],
            'cashier_exp' => ['numeric', 'digits_between:0,1'],
            'entrance_exp' => ['numeric', 'digits_between:0,1'],
            'infodesk_exp' => ['numeric', 'digits_between:0,1'],
        ];
    }
}
