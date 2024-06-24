<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser;

class Code
{
    public static function match(
        string $line,
        array &$matches = []
    ): bool
    {
        // Multiple format resolver
        // https://geminiprotocol.net/docs/gemtext.gmi#preformatted-text
        switch (true)
        {
            // Inline ^```preformatted```
            case preg_match(
                '/^(?<tag>[`]{3})(?<alt>[^`]+)(?<close>[`]{3})$/m',
                $line,
                $matches
            ):

                return true;

            // Multiline with optional alt support
            case preg_match(
                '/^(?<tag>[`]{3})(?<alt>[^`]+)$/m',
                $line,
                $matches
            ):
                return true;
        }

        return false;
    }

    public static function getAlt(
        string $line
    ): ?string
    {
        $matches = [];

        if (self::match($line, $matches))
        {
            if (isset($matches['alt']))
            {
                $alt = trim(
                    $matches['alt']
                );

                if ($alt)
                {
                    return $alt;
                }
            }
        }

        return null;
    }

    public static function isInline(
        string $line
    ): bool
    {
        $matches = [];

        if (self::match($line, $matches))
        {
            return isset($matches['close']);
        }

        return false;
    }
}