<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser;

class Listing
{
    public static function match(
        string $line,
        array &$matches = []
    ): bool
    {
        return (bool) preg_match(
            '/^\*(?<item>.*)$/m',
            $line,
            $matches
        );
    }

    public static function getItem(
        string $line
    ): ?string
    {
        $matches = [];

        if (self::match($line, $matches))
        {
            if (isset($matches['item']))
            {
                $item = trim(
                    $matches['item']
                );

                if ($item)
                {
                    return $item;
                }
            }
        }

        return null;
    }
}