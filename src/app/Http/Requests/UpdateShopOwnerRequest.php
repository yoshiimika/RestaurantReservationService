<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateShopOwnerRequest extends FormRequest
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
        $shopOwnerId = $this->route('shopOwner')->id;
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($shopOwnerId),
            ],
            'current_password' => 'required|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'shop_id' => 'nullable|exists:shops,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
                $shopOwner = $this->route('shopOwner');
                if (!Hash::check($this->current_password, $shopOwner->password)) {
                    $validator->errors()->add('current_password', '現在のパスワードが正しくありません。');
                }
        });
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'current_password.required' => '現在のパスワードを入力してください。',
            'new_password.min' => '新しいパスワードは8文字以上で入力してください。',
            'new_password.confirmed' => '新しいパスワードが一致しません。',
            'shop_id.exists' => '選択された店舗は存在しません。',
        ];
    }
}
