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
            'body' => 'required|max:500',
            'prefecture' => 'required|max:10',
            'cities' => 'max:30',
            'genre' => 'max:30',
            'meeting_date_time' => 'max:30',
            'age' => 'max:20',
            'venue' => 'max:30',
            'membership_fee' => 'max:30',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'prefecture' => '都道府県',
            'cities' => '区市町村',
            'genre' => 'ジャンル',
            'meeting_date_time' => '開催日時',
            'image' => '画像',
            'age' => '年齢',
            'venue' => '会場',
            'membership_fee' => '会費',
            'tags' => 'タグ',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }

    public function flash()
    {
        $request->flashOnly(['prefecture', 'meeting_date_time']);
        
    }
}
