<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser;

class Header implements \Yggverse\Gemtext\Interface\Parser
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
        string $line,
        array $matches = []
    ): ?int
    {
        if (!$matches)
        {
            self::match(
                $line,
                $matches
            );
        }

        if (isset($matches['level']))
        {
            return (int) strlen(
                $matches['level']
            );
        }

        return null;
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