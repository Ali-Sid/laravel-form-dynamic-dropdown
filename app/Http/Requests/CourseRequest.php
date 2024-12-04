<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'price' => 'required|numeric|min:0',
        ];

        $category = \App\Models\Category::find($this->input('category_id'));
        if ($category && $category->slug === 'live-class') {
            $rules = array_merge($rules, [
                'meeting_date' => 'required|date',
                'meeting_time' => 'required',
                'meeting_name' => 'required|string|max:255',
                'timezone' => 'required|string',
            ]);
        }

        return $rules;
    }
}