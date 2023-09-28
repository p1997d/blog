<?php

namespace App\Http\Requests\Main\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Это поле необходимо заполнить.',
            'title.string' => 'Значение поля должно быть строкой.',
            'content.required' => 'Это поле необходимо заполнить.',
            'content.string' => 'Значение поля должно быть строкой.',
            'category_id.required' => 'Необходимо выбрать категорию.',
            'category_id.integer' => 'Значение поля должно быть целым числом.',
            'category_id.exists' => 'Выбранная категория не существует.',
            'tag_ids.required' => 'Пожалуйста, выберите хотя бы один тег.',
            'tag_ids.array' => 'Значение поля должно быть массивом.',
        ];
    }
}