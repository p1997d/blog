<?php

namespace App\Http\Requests\Main\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'content' => 'required|string',
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
            'reply_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Это поле необходимо заполнить.',
            'content.string' => 'Значение поля должно быть строкой.',
            'post_id.required' => 'Это поле необходимо заполнить.',
            'post_id.integer' => 'Значение поля должно быть целым числом.',
            'user_id.required' => 'Это поле необходимо заполнить.',
            'user_id.integer' => 'Значение поля должно быть целым числом.',
            'reply_id.integer' => 'Значение поля должно быть целым числом.',
        ];
    }

}