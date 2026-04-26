<?php

namespace App\Http\Requests\Admin;

use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:'.implode(',', Section::TYPES)],
            'sort_order' => ['required', 'integer', 'min:1'],
            'content' => ['required', 'json'],
        ];
    }

    protected function passedValidation(): void
    {
        $decoded = json_decode((string) $this->input('content'), true);

        if (! is_array($decoded)) {
            throw ValidationException::withMessages([
                'content' => 'Section content must decode into a JSON object or array.',
            ]);
        }
    }
}
