<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize(): bool
    {
        return boolval(auth()->id());
    }

    public function rules()
    {
        return [
            'lang' => 'required',
            'category_id' => 'required|numeric',
            'image' => 'nullable|image|max:524'
        ];
    }
}
