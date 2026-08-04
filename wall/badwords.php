<?php
declare(strict_types=1);

/**
 * Minimal classroom profanity blocklist. Add more words as needed —
 * one per line, lowercase.
 */
function wall_badwords(): array
{
    return [
        'fuck', 'shit', 'bitch', 'asshole', 'bastard', 'dick', 'pussy',
        'cunt', 'slut', 'whore', 'nigger', 'faggot', 'retard', 'douche',
    ];
}

function wall_is_profane(string $text): bool
{
    $normalized = strtolower($text);

    // collapse common leetspeak substitutions before matching
    $normalized = strtr($normalized, [
        '@' => 'a', '4' => 'a', '3' => 'e', '1' => 'i', '!' => 'i',
        '0' => 'o', '$' => 's', '5' => 's',
    ]);

    foreach (wall_badwords() as $word) {
        if (preg_match('/\b' . preg_quote($word, '/') . '\b/i', $normalized) === 1) {
            return true;
        }
    }

    return false;
}
