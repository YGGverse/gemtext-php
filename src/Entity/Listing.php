<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Listing implements \Yggverse\Gemtext\Interface\Entity
{
    public const TAG = '*';

    private ?string $_item;

    public function __construct(
        ?string $item = null
    ) {
        $this->setItem(
            $item
        );
    }

    public function setItem(
        ?string $item
    ): void
    {
        if ($item)
        {
            $item = trim(
                $item
            );
        }

        $this->_item = $item;
    }

    public function getItem(): ?string
    {
        return $this->_item;
    }

    public function toString(): string
    {
        return trim(
            sprintf(
                '%s %s',
                self::TAG,
                $this->_item
            )
        );
    }
}