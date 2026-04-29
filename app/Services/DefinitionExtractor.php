<?php

namespace App\Services;

class DefinitionExtractor
{
    public function extract(string $markdown): array
    {
        $definitions = [];
        preg_match_all(
            '/"([^"]+)"\s+means\s+(.+?)(?=;\s*\n|"\w+"\s+means|\z)/s',
            $markdown,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $definitions[$match[1]] = trim($match[2], "; \n");
        }

        return $definitions;
    }

    public function enrichChunk(string $content, array $definitions): string
    {
        $used = [];
        foreach ($definitions as $term => $def) {
            if (str_contains($content, $term)) {
                $used[$term] = $def;
            }
        }

        if (empty($used)) {
            return $content;
        }

        $prefix = "Relevant definitions:\n";
        foreach ($used as $term => $def) {
            $prefix .= "- \"{$term}\" means {$def}\n";
        }

        return $prefix . "\n---\n\n" . $content;
    }
}