<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Note;

class CreateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $priorityOptions = Note::getPrioritiesOptions();
        return [
            'priority' => ['required', 'string', 'in_array:' . $priorityOptions],
            'description' => ['required', 'string', 'min:3'],
            'date' => ['required', 'date'],
            'completed' => ['sometimes', 'required', 'boolean'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ];
    }
}
