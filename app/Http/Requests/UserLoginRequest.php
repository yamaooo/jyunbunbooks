<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required | email',
            'password' => 'required | min:8',
        ];
    }

    public function messages()
    {
        return [
        'email.required'  => 'メールアドレスは必須入力です。正しくご入力ください。',
        'email.email'  => 'メールアドレスは必須入力です。正しくご入力ください。',
        'password.required'  => 'パスワードは必須入力です。8ケタ以上でご入力ください。',
        ];
    }
}
