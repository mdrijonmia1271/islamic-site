<?php

if (! function_exists('highlightSearch')) {
    /**
     * Safely highlight search terms in a text string.
     */
    function highlightSearch(?string $text, ?string $query): string
    {
        if (! $text) {
            return '';
        }

        if (! $query || trim($query) === '') {
            return e($text);
        }

        $escapedText = e($text);
        $escapedQuery = preg_quote(trim($query), '/');

        return preg_replace(
            '/' . $escapedQuery . '/iu',
            '<mark class="bg-amber-200 dark:bg-amber-500/40 text-emerald-950 dark:text-amber-200 font-semibold px-0.5 rounded">$0</mark>',
            $escapedText
        );
    }
}
