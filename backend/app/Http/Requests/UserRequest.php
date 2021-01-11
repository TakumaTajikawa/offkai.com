<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    private const GUEST_USER_EMAIL = 'guestuser@example.com';

    public function rules()
    {
        if(Auth::user()->email == self::GUEST_USER_EMAIL) {
            return [
                'introduction' => 'max:255',
            ];
        } else {
            return [
                'name' => 'required|min:1|max:15' . Rule::unique('users')->ignore(Auth::id()),
                'email' => 'required|max:255' . Rule::unique('users')->ignore(Auth::id()),
                'image' => 'file|max:3000',
                'introduction' => 'max:255',
            ];
        }
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'image' => 'プロフィール画像',
            'introduction' => '紹介文',
        ];
    }
}
