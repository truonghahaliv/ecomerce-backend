<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|max:255',
            // Thêm các rules khác nếu cần thiết
        ];
    }
}
