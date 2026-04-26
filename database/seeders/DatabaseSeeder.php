<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@lawyercms.test'],
            [
                'name' => 'Lawyer CMS Admin',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        $home = Page::query()->updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'meta_title' => 'Trusted Legal Counsel | Lawyer CMS Demo',
                'meta_description' => 'A sample homepage for a modular Laravel lawyer website CMS.',
            ]
        );

        $sections = [
            [
                'type' => 'hero',
                'sort_order' => 1,
                'content' => [
                    'heading' => 'Experienced Legal Counsel for Complex Matters',
                    'subheading' => 'Clear advice, steady advocacy, and practical strategy for individuals and businesses.',
                    'cta_text' => 'Book Consultation',
                    'cta_link' => '/pages/contact',
                ],
            ],
            [
                'type' => 'services',
                'sort_order' => 2,
                'content' => [
                    'title' => 'Practice Areas',
                    'items' => [
                        [
                            'title' => 'Family Law',
                            'description' => 'Support for divorce, custody, maintenance, and related disputes.',
                        ],
                        [
                            'title' => 'Criminal Defense',
                            'description' => 'Strategic defense from first hearing through trial.',
                        ],
                        [
                            'title' => 'Corporate Advisory',
                            'description' => 'Contracts, compliance, and dispute prevention for growing businesses.',
                        ],
                    ],
                ],
            ],
            [
                'type' => 'text',
                'sort_order' => 3,
                'content' => [
                    'title' => 'Why Clients Choose Us',
                    'body' => 'We combine careful preparation with practical communication, so clients understand their options and feel supported throughout the case.',
                ],
            ],
            [
                'type' => 'testimonials',
                'sort_order' => 4,
                'content' => [
                    'title' => 'Client Feedback',
                    'items' => [
                        [
                            'quote' => 'Professional, responsive, and deeply prepared for every hearing.',
                            'name' => 'Former Client',
                        ],
                        [
                            'quote' => 'They gave us a clear path through a stressful legal situation.',
                            'name' => 'Business Owner',
                        ],
                    ],
                ],
            ],
            [
                'type' => 'cta',
                'sort_order' => 5,
                'content' => [
                    'heading' => 'Need legal guidance now?',
                    'text' => 'Schedule a confidential consultation and get clarity on your next step.',
                    'button_text' => 'Contact the Firm',
                    'button_link' => '/pages/contact',
                ],
            ],
            [
                'type' => 'contact',
                'sort_order' => 6,
                'content' => [
                    'title' => 'Visit Our Office',
                    'phone' => '(555) 123-4567',
                    'email' => 'info@examplelaw.com',
                    'address' => '100 Main Street, Suite 200, City, State',
                    'hours' => 'Mon-Fri 9:00 AM - 5:00 PM',
                ],
            ],
        ];

        foreach ($sections as $section) {
            Section::query()->updateOrCreate(
                [
                    'page_id' => $home->id,
                    'type' => $section['type'],
                    'sort_order' => $section['sort_order'],
                ],
                [
                    'content' => json_encode($section['content'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
                ]
            );
        }

        Page::query()->updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact',
                'meta_title' => 'Contact Our Law Office',
                'meta_description' => 'Reach out to schedule a consultation or ask a question.',
            ]
        );
    }
}
