<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'amount' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => '支払額は必須です。',
            'amount.integer' => '支払額は整数で入力してください。',
            'amount.min' => '支払額は1円以上でなければなりません。',
        ];
    }
}
