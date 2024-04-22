<?php

namespace App\Http\Requests;

use App\Rules\AtLeastOneCategorySelected;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueTaskTitle;

class TaskStoreRequest extends FormRequest
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
            'name' => ['required', 'string', new UniqueTaskTitle($this->input('categories'))],
            'description' => ['required', 'string'],
            'priority' => ['required', 'integer', 'min:1'],
            'categories' => ['required', 'array', new AtLeastOneCategorySelected],

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The task name field is required.',
            'description.required' => 'The task description is required.',
            'priority.required' => 'The task priority field is required & must be greater then 0.',
            'categories.required' => 'Please select atlest one category.',

        ];
    }
}
