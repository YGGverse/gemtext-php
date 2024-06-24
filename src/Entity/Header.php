<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Header implements \Yggverse\Gemtext\Interface\Entity
{
    public const TAG = '#';

    private int $_level;

    private ?string $_text;

    public function __construct(
        ?string $text = null,
        int $level = 1
    ) {
        $this->setLevel(
            $level
        );

        $this->setText(
            $text
        );
    }

    public function setLevel(
        int $level
    ): void
    {
        if (!in_array($level, [1, 2, 3]))
        {
            throw new \Exception(
                _('Incorrect header level')
            );
        }

        $this->_level = $level;
    }

    public function getLevel(): int
    {
        return $this->_level;
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
        return str_repeat(
            self::TAG,
            $this->_level
        ) . $this->_text;
    }
}