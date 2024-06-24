<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Code
{
    public const TAG = '```';

    private ?string $_alt;

    private bool $_inline;

    public function __construct(
        ?string $alt = null,
        bool $inline = false
    ) {
        $this->setAlt(
            $alt
        );

        $this->setInline(
            $inline
        );
    }

    public function setAlt(
        ?string $alt
    ): void
    {
        if ($alt)
        {
            $alt = trim(
                $alt
            );
        }

        $this->_alt = $alt;
    }

    public function getAlt(): ?string
    {
        return $this->_alt;
    }

    public function setInline(
        bool $inline
    ): void
    {
        $this->_inline = $inline;
    }

    public function isInline(): bool
    {
        return $this->_inline;
    }

    public function toString(): string
    {
        if ($this->_inline)
        {
            return $this->_alt ? self::TAG . $this->_alt . self::TAG
                               : self::TAG;
        }

        return self::TAG;
    }
}