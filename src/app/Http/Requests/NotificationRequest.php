<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'message_content' => ['required', 'string'],
            'user_ids' => ['required', 'array', 'min:1'],
            'user_ids.*' => ['exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'message_content.required' => 'お知らせ内容は必須です。',
            'user_ids.required' => '少なくとも1人のユーザーを選択してください。',
            'user_ids.*.exists' => '選択されたユーザーが無効です。',
        ];
    }
}
