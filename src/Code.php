<?php

declare(strict_types=1);

namespace Yggverse\Gemtext;

class Code
{
    /*
     * Helper method
     *
     * Detect line given is escaped by previous iteration
     */
    public static function escaped(string $line, bool &$status): bool
    {
        if (preg_match('/^```/m', $line))
        {
            $status = !($status); // toggle
        }

        return $status;
    }
}