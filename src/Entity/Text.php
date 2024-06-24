<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Text
{
    private string $_data;

    public function __construct(
         string $data
    ) {
        $this->setData(
            $data
        );
    }

    public function setData(
        string $data
    ): void
    {
        $this->_data = trim(
            $data
        );
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