<?php

namespace App\Http\Requests\Admin;

use App\Models\Section;
use App\Support\SectionContent;
use App\Support\Sections\SectionRegistry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $type = (string) $this->input('type', 'hero');
        $contentFields = $this->input('content_fields', []);

        if (is_array($contentFields)) {
            $this->merge([
                'content' => json_encode(SectionContent::buildFromFields($type, $contentFields)),
            ]);
        }
    }

    public function rules(): array
    {
        $rules = [
            'type' => ['required', 'string', 'in:'.implode(',', Section::availableTypes())],
            'sort_order' => ['required', 'integer', 'min:1'],
            'content' => ['nullable', 'json'],
        ];

        return array_merge($rules, SectionRegistry::rules((string) $this->input('type')));
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
