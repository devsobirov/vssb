<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{

    public function authorize() : bool
    {
        return boolval(auth()->id());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'array|required',
            'slug' => ['required', 'string', 'max:255',
                function ($attribute, $value, $fail) {
                    $slug = Str::slug(trim(strtolower($value)));
                    $unique = !Category::where('slug', $slug)
                        ->where('id', '<>', $this->route()->parameter('id'))
                        ->first();

                    if (!$unique) {
                        $fail("Ushbu URL manzil - $value ($slug) bazada mavjud, iltimos boshqa URL kiriting");
                    }
            },]
        ];
    }
}
