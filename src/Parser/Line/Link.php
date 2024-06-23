<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser\Line;

class Link
{
    public static function match(
        \Yggverse\Gemtext\Entity\Line $line,
        array &$matches = []
    ): bool
    {
        if ($line->isEscaped())
        {
            return false;
        }

        return (bool) preg_match(
            '/^=>\s*(?<address>[^\s]+)(\s(?<date>\d{4}-\d{2}-\d{2}))?(\s(?<alt>.+))?$/m',
            $line->getData(),
            $matches
        );
    }

    public static function getAddress(
        \Yggverse\Gemtext\Entity\Line $line
    ): ?string
    {
        $matches = [];

        if (self::match($line, $matches))
        {
            if (isset($matches['address']))
            {
                $address = trim(
                    $matches['address']
                );

                if ($address)
                {
                    return $address;
                }
            }
        }

        return null;
    }

    public static function getDate(
        \Yggverse\Gemtext\Entity\Line $line
    ): ?string
    {
        $matches = [];

        if (self::match($line, $matches))
        {
            if (isset($matches['date']))
            {
                $date = trim(
                    $matches['date']
                );

                if ($date)
                {
                    return $date;
                }
            }
        }

        return null;
    }

    public static function getAlt(
        \Yggverse\Gemtext\Entity\Line $line
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
}