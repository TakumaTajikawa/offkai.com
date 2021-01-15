<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'title' => 'required|max:50',
            'body' => 'required|max:3000|min:80',
            'prefecture' => 'required|max:10',
            'address' => 'max:100',
            'meeting_date_time' => 'required|max:50',
            'age' => 'max:50',
            'venue' => 'max:50',
            'membership_fee' => 'max:50',
            'capacity' => 'integer|max:50',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '説明文',
            'prefecture' => '都道府県',
            'address' => '住所',
            'meeting_date_time' => '開催日時',
            'image' => '画像',
            'age' => '募集年齢',
            'venue' => '会場',
            'membership_fee' => '会費',
            'tags' => 'タグ',
            'capacity' => '定員',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)->map(function ($requestTag) {
                return $requestTag->text;
            });
    }

    public function flash()
    {
        $request->flashOnly(['prefecture', 'meeting_date_time']);
        
    }
}
