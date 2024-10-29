<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'shop_id' => ['required', 'exists:shops,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'number' => ['required', 'integer', 'min:1'],
        ];
    }


    public function messages()
    {
        return [
            'shop_id.required' => '店舗を選択してください。',
            'shop_id.exists' => '選択された店舗は存在しません。',
            'date.required' => '予約日を選択してください。',
            'time.required' => '予約時間を選択してください。',
            'number.required' => '人数を入力してください。',
        ];
    }
}
