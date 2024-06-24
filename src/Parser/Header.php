<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser;

class Header
{
    public static function match(
        string $line,
        array &$matches = []
    ): bool
    {
        return (bool) preg_match(
            '/^(?<level>#{1,3})(?<text>.*)$/m',
            $line,
            $matches
        );
    }

    public static function getLevel(
        string $line
    ): ?int
    {
        $matches = [];

        if (self::match($line, $matches))
        {
            if (isset($matches['level']))
            {
                return (int) strlen(
                    $matches['level']
                );
            }
        }

        return null;
    }

    public static function getText(
        string $line
    ): ?string
    {
        $matches = [];

        if (self::match($line, $matches))
        {
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
        }

        return null;
    }
}