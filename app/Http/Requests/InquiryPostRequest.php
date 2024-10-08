<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['nullable', 'max:512'], // お名前
            'tel'   => ['nullable', 'max:32'], // 電話番号
            'email' => ['nullable', 'email:filter','max:254'], // emailアドレス
            'title' => ['required', 'string','max:256'], // タイトル
            'body'  => ['required', 'string','max:65535'], // 本文
        ];
    }
}
