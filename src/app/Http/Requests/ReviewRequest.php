<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }


    public function messages(): array
    {
        return [
            'rating.required' => '評価を入力してください。',
            'rating.integer' => '評価は数字で入力してください。',
            'rating.min' => '最低1以上の評価をしてください。',
            'rating.max' => '最高5までの評価にしてください。',
            'comment.max' => 'コメントは最大1000文字までです。',
        ];
    }
}
