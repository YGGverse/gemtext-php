<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser;

class Quote implements \Yggverse\Gemtext\Interface\Parser
{
    public static function match(
        string $line,
        array &$matches = []
    ): bool
    {
        return (bool) preg_match(
            '/^>(?<text>.*)$/m',
            $line,
            $matches
        );
    }

    public static function getText(
        string $line,
        array $matches = []
    ): ?string
    {
        if (!$matches)
        {
            self::match(
                $line,
                $matches
            );
        }

        if (isset($matches['text']))
        {
            $text = trim(
                $matches['text']
            );

            if ($text)
            {
                return $text;
            }
        }

        return null;
    }
}