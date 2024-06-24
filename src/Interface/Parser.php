<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Interface;

interface Parser
{
    public static function match(
        string $line,
        array &$matches = []
    ): bool;
}