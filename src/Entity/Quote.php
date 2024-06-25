<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Quote implements \Yggverse\Gemtext\Interface\Entity
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

    public function getText(): ?string
    {
        return $this->_text;
    }

    public function toString(): string
    {
        return trim(
            sprintf(
                '%s %s',
                self::TAG,
                $this->_text
            )
        );
    }
}