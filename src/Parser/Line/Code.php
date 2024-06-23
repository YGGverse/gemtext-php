<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser\Line;

class Code
{
    public static function match(
        \Yggverse\Gemtext\Entity\Line $line,
        array &$matches = [],
         bool &$inline  = false
    ): bool
    {
        // Multiple format resolver
        // https://geminiprotocol.net/docs/gemtext.gmi#preformatted-text
        switch (true)
        {
            // Inline ^```preformatted```
            case preg_match(
                '/^[`]{3}\s*((?<code>[^`]+))?[`]{3}$/m',
                $line->getData(),
                $matches
            ):
                // Toggle escaped status
                return $inline = true;

            // Multiline with optional alt support
            case preg_match(
                '/^[`]{3}\s*(?<alt>[^`]+)$/m',
                $line->getData(),
                $matches
            ):
                return true;
        }

        return false;
    }
}