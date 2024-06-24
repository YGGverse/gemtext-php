<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Parser;

class Link implements \Yggverse\Gemtext\Interface\Parser
{
    public static function match(
        string $line,
        array &$matches = []
    ): bool
    {
        return (bool) preg_match(
            '/^=>\s*(?<address>[^\s]+)(\s(?<date>\d{4}-\d{2}-\d{2}))?(\s(?<alt>.+))?$/m',
            $line,
            $matches
        );
    }

    public static function getAddress(
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

        return null;
    }

    public static function getDate(
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

        return null;
    }

    public static function getAlt(
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

        return null;
    }
}