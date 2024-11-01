<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'area' => ['required', 'exists:areas,id'],
            'genre' => ['required', 'exists:genres,id'],
            'shop_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'outline' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください。',
            'name.string' => '店舗名は文字列で入力してください。',
            'name.max' => '店舗名は255文字以内で入力してください。',
            'area.required' => 'エリアを選択してください。',
            'area.exists' => '選択されたエリアが無効です。',
            'genre.required' => 'ジャンルを選択してください。',
            'genre.exists' => '選択されたジャンルが無効です。',
            'shop_image.image' => '店舗画像は有効な画像ファイルを選択してください。',
            'shop_image.mimes' => '店舗画像はjpeg, png, jpg, gif形式のファイルを選択してください。',
            'shop_image.max' => '店舗画像のサイズは2MB以内でアップロードしてください。',
            'outline.max' => '店舗説明は100文字以内で入力してください。',
        ];
    }
}
