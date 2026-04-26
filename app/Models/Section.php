<?php

namespace App\Models;

use App\Support\Sections\SectionRegistry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;

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

    public static function availableTypes(): array
    {
        return SectionRegistry::types();
    }
}
