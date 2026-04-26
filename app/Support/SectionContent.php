<?php

namespace App\Support;

use App\Support\Sections\SectionRegistry;

class SectionContent
{
    public static function exampleData(string $type): array
    {
        return SectionRegistry::exampleData($type);
    }

    public static function examples(): array
    {
        return collect(SectionRegistry::all())
            ->mapWithKeys(fn (array $definition, string $type) => [$type => $definition['example'] ?? []])
            ->all();
    }

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

    public static function buildFromFields(string $type, array $fields): array
    {
        return SectionRegistry::buildContent($type, $fields);
    }

    public static function example(string $type): string
    {
        return json_encode(
            self::exampleData($type),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
