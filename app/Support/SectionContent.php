<?php

namespace App\Support;

use Illuminate\Support\Arr;

class SectionContent
{
    public static function sanitizeJson(string $json): string
    {
        $decoded = json_decode($json, true);

        if (! is_array($decoded)) {
            return json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        }

        return json_encode(
            self::sanitizeValue($decoded),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    public static function sanitizeValue(mixed $value): mixed
    {
        if (is_array($value)) {
            return array_map(fn (mixed $item) => self::sanitizeValue($item), $value);
        }

        if (is_string($value)) {
            return trim(strip_tags($value));
        }

        return $value;
    }

    public static function example(string $type): string
    {
        $examples = [
            'hero' => [
                'heading' => 'Best Criminal Lawyer',
                'subheading' => '10+ years of trial experience',
                'cta_text' => 'Book Consultation',
                'cta_link' => '/pages/contact',
            ],
            'text' => [
                'title' => 'About the Firm',
                'body' => 'We provide practical legal guidance with clear communication and strong courtroom advocacy.',
            ],
            'services' => [
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
            'testimonials' => [
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
            'contact' => [
                'title' => 'Contact Our Office',
                'phone' => '(555) 123-4567',
                'email' => 'info@examplelaw.com',
                'address' => '100 Main Street, Suite 200, City, State',
                'hours' => 'Mon-Fri 9:00 AM - 5:00 PM',
            ],
            'cta' => [
                'heading' => 'Need legal guidance now?',
                'text' => 'Schedule a confidential consultation with our team today.',
                'button_text' => 'Request Consultation',
                'button_link' => '/pages/contact',
            ],
        ];

        return json_encode(
            Arr::get($examples, $type, []),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
