<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;

    public const TYPES = [
        'hero',
        'text',
        'services',
        'testimonials',
        'contact',
        'cta',
    ];

    protected $fillable = [
        'page_id',
        'type',
        'sort_order',
        'content',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function contentData(): array
    {
        $decoded = json_decode($this->content, true);

        return is_array($decoded) ? $decoded : [];
    }
}
