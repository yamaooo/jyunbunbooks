<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
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
            'name' => 'required | max:10',
            'email' => ['required',  'email',  Rule::unique('users')->ignore(Auth::id())],
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'ユーザーネームは必須入力です。10文字以内でご入力ください。',
            'name.max'  => 'ユーザーネームは必須入力です。10文字以内でご入力ください。',
            'email.required'  => 'メールアドレスは必須入力です。正しくご入力ください。',
            'email.email'  => 'メールアドレスは必須入力です。正しくご入力ください。',
            'email.unique'  => 'このメールアドレスはすでに使用されています。',
        ];
    }
}
