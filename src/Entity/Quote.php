<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Quote
{
    public const TAG = '>';

    private ?string $_text;

    public function __construct(
        ?string $text = null
    ) {
        $this->setText(
            $text
        );
    }

    public function setText(
        ?string $text
    ): void
    {
        if ($text)
        {
            $text = trim(
                $text
            );
        }

        $this->_text = $text;
    }

    public function Text(): ?string
    {
        return $this->_text;
    }

    public function toString(): string
    {
        return self::TAG . ' ' . $this->_text;
    }
}