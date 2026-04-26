<?php

namespace App\Support\Sections;

use Illuminate\Support\Arr;

class SectionRegistry
{
    public static function all(): array
    {
        return [
            'hero' => [
                'label' => 'Hero',
                'fields' => [
                    ['name' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                    ['name' => 'subheading', 'label' => 'Subheading', 'type' => 'textarea', 'rows' => 4],
                    ['name' => 'cta_text', 'label' => 'CTA Text', 'type' => 'text', 'column' => 'col-md-6'],
                    ['name' => 'cta_link', 'label' => 'CTA Link', 'type' => 'text', 'column' => 'col-md-6'],
                ],
                'rules' => [
                    'content_fields.heading' => ['required', 'string', 'max:255'],
                    'content_fields.subheading' => ['nullable', 'string', 'max:1000'],
                    'content_fields.cta_text' => ['nullable', 'string', 'max:255'],
                    'content_fields.cta_link' => ['nullable', 'string', 'max:255'],
                ],
                'example' => [
                    'heading' => 'Best Criminal Lawyer',
                    'subheading' => '10+ years of trial experience',
                    'cta_text' => 'Book Consultation',
                    'cta_link' => '/pages/contact',
                ],
            ],
            'text' => [
                'label' => 'Text',
                'fields' => [
                    ['name' => 'title', 'label' => 'Title', 'type' => 'text'],
                    ['name' => 'body', 'label' => 'Body', 'type' => 'textarea', 'rows' => 8],
                ],
                'rules' => [
                    'content_fields.title' => ['required', 'string', 'max:255'],
                    'content_fields.body' => ['required', 'string', 'max:5000'],
                ],
                'example' => [
                    'title' => 'About the Firm',
                    'body' => 'We provide practical legal guidance with clear communication and strong courtroom advocacy.',
                ],
            ],
            'services' => [
                'label' => 'Services',
                'fields' => [
                    ['name' => 'title', 'label' => 'Section Title', 'type' => 'text'],
                    [
                        'name' => 'items',
                        'label' => 'Service Items',
                        'type' => 'repeater',
                        'rows' => 4,
                        'item_key' => 'title',
                        'fields' => [
                            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'column' => 'col-md-4'],
                            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rows' => 2, 'column' => 'col-md-8'],
                        ],
                    ],
                ],
                'rules' => [
                    'content_fields.title' => ['required', 'string', 'max:255'],
                    'content_fields.items' => ['required', 'array', 'min:1'],
                    'content_fields.items.*.title' => ['required', 'string', 'max:255'],
                    'content_fields.items.*.description' => ['required', 'string', 'max:1000'],
                ],
                'example' => [
                    'title' => 'Practice Areas',
                    'items' => [
                        [
                            'title' => 'Family Law',
                            'description' => 'Legal support for divorce, custody, and family matters.',
                        ],
                        [
                            'title' => 'Criminal Defense',
                            'description' => 'Focused defense strategy from investigation through trial.',
                        ],
                    ],
                ],
            ],
            'testimonials' => [
                'label' => 'Testimonials',
                'fields' => [
                    ['name' => 'title', 'label' => 'Section Title', 'type' => 'text'],
                    [
                        'name' => 'items',
                        'label' => 'Testimonial Items',
                        'type' => 'repeater',
                        'rows' => 4,
                        'item_key' => 'name',
                        'fields' => [
                            ['name' => 'quote', 'label' => 'Quote', 'type' => 'textarea', 'rows' => 3, 'column' => 'col-md-8'],
                            ['name' => 'name', 'label' => 'Client Name', 'type' => 'text', 'column' => 'col-md-4'],
                        ],
                    ],
                ],
                'rules' => [
                    'content_fields.title' => ['required', 'string', 'max:255'],
                    'content_fields.items' => ['required', 'array', 'min:1'],
                    'content_fields.items.*.quote' => ['required', 'string', 'max:1000'],
                    'content_fields.items.*.name' => ['required', 'string', 'max:255'],
                ],
                'example' => [
                    'title' => 'Client Testimonials',
                    'items' => [
                        [
                            'quote' => 'Professional, responsive, and deeply prepared.',
                            'name' => 'A. Client',
                        ],
                        [
                            'quote' => 'They explained every step and fought hard for our case.',
                            'name' => 'B. Client',
                        ],
                    ],
                ],
            ],
            'contact' => [
                'label' => 'Contact',
                'fields' => [
                    ['name' => 'title', 'label' => 'Title', 'type' => 'text'],
                    ['name' => 'phone', 'label' => 'Phone', 'type' => 'text', 'column' => 'col-md-6'],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'column' => 'col-md-6'],
                    ['name' => 'address', 'label' => 'Address', 'type' => 'textarea', 'rows' => 3],
                    ['name' => 'hours', 'label' => 'Office Hours', 'type' => 'text'],
                ],
                'rules' => [
                    'content_fields.title' => ['required', 'string', 'max:255'],
                    'content_fields.phone' => ['nullable', 'string', 'max:255'],
                    'content_fields.email' => ['nullable', 'email', 'max:255'],
                    'content_fields.address' => ['nullable', 'string', 'max:1000'],
                    'content_fields.hours' => ['nullable', 'string', 'max:255'],
                ],
                'example' => [
                    'title' => 'Contact Our Office',
                    'phone' => '(555) 123-4567',
                    'email' => 'info@examplelaw.com',
                    'address' => '100 Main Street, Suite 200, City, State',
                    'hours' => 'Mon-Fri 9:00 AM - 5:00 PM',
                ],
            ],
            'cta' => [
                'label' => 'Call To Action',
                'fields' => [
                    ['name' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                    ['name' => 'text', 'label' => 'Text', 'type' => 'textarea', 'rows' => 5],
                    ['name' => 'button_text', 'label' => 'Button Text', 'type' => 'text', 'column' => 'col-md-6'],
                    ['name' => 'button_link', 'label' => 'Button Link', 'type' => 'text', 'column' => 'col-md-6'],
                ],
                'rules' => [
                    'content_fields.heading' => ['required', 'string', 'max:255'],
                    'content_fields.text' => ['required', 'string', 'max:1000'],
                    'content_fields.button_text' => ['nullable', 'string', 'max:255'],
                    'content_fields.button_link' => ['nullable', 'string', 'max:255'],
                ],
                'example' => [
                    'heading' => 'Need legal guidance now?',
                    'text' => 'Schedule a confidential consultation with our team today.',
                    'button_text' => 'Request Consultation',
                    'button_link' => '/pages/contact',
                ],
            ],
        ];
    }

    public static function types(): array
    {
        return array_keys(self::all());
    }

    public static function definition(string $type): array
    {
        return Arr::get(self::all(), $type, []);
    }

    public static function labels(): array
    {
        return collect(self::all())
            ->mapWithKeys(fn (array $definition, string $type) => [$type => $definition['label']])
            ->all();
    }

    public static function exampleData(string $type): array
    {
        return Arr::get(self::definition($type), 'example', []);
    }

    public static function rules(string $type): array
    {
        return Arr::get(self::definition($type), 'rules', []);
    }

    public static function buildContent(string $type, array $fields): array
    {
        return self::normalizeFields(
            Arr::get(self::definition($type), 'fields', []),
            $fields
        );
    }

    protected static function normalizeFields(array $definitions, array $fields): array
    {
        $normalized = [];

        foreach ($definitions as $field) {
            $name = $field['name'];
            $type = $field['type'];

            if ($type === 'repeater') {
                $rows = Arr::get($fields, $name, []);
                $normalized[$name] = self::normalizeRepeater($field, is_array($rows) ? $rows : []);
                continue;
            }

            $normalized[$name] = Arr::get($fields, $name, '');
        }

        return $normalized;
    }

    protected static function normalizeRepeater(array $definition, array $rows): array
    {
        $normalized = [];

        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }

            $entry = [];

            foreach ($definition['fields'] as $subField) {
                $entry[$subField['name']] = Arr::get($row, $subField['name'], '');
            }

            if (collect($entry)->filter(fn (mixed $value) => filled($value))->isNotEmpty()) {
                $normalized[] = $entry;
            }
        }

        return $normalized;
    }
}
