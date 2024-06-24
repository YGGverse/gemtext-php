<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Text implements \Yggverse\Gemtext\Interface\Entity
{
    private string $_data;

    public function __construct(
         string $data = '',
         bool $trim = false
    ) {
        $this->setData(
            $data,
            $trim
        );
    }

    public function setData(
        string $data,
        bool $trim = false
    ): void
    {
        $this->_data = $trim ? trim(
            $data
        ) : $data;
    }

    public function getData(): string
    {
        return $this->_data;
    }

    public function toString(): string
    {
        return $this->_data;
    }
}