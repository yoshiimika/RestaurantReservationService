<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'date' => ['required', 'date', 'after_or_equal:' . Carbon::now()->toDateString()],
            'time' => ['required', 'date_format:H:i', function ($attribute, $value, $fail) {
                $reservationDateTime = Carbon::parse($this->date . ' ' . $value);
                if ($reservationDateTime->isBefore(Carbon::now())) {
                    $fail('現在の日時より後の時間を指定してください。');
                }
            }],
            'number' => ['required', 'integer', 'min:1'],
        ];
    }


    public function messages()
    {
        return [
            'shop_id.required' => '店舗を選択してください。',
            'shop_id.exists' => '選択された店舗は存在しません。',
            'date.required' => '予約日を選択してください。',
            'date.after_or_equal' => '今日以降の日付を指定してください。',
            'time.required' => '予約時間を選択してください。',
            'number.required' => '人数を入力してください。',
        ];
    }
}
