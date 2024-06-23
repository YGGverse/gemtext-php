<?php

declare(strict_types=1);

namespace Yggverse\Gemtext;

class Line
{
    private string $_data;

    private bool $_escaped;
    private ?int $_number;

    public function __construct(string $data = '', bool $escaped = false, ?int $number = null)
    {
        $this->setData(
            $data
        );

        $this->setEscaped(
            $escaped
        );

        $this->setNumber(
            $number
        );
    }

    public function getData(): string
    {
        return $this->_data;
    }

    public function setData(string $data): void
    {
        $this->_data = $data;
    }

    public function getEscaped(): bool
    {
        return $this->_escaped;
    }

    public function setEscaped(bool $escaped): void
    {
        $this->_escaped = $escaped;
    }

    public function getNumber(): ?int
    {
        return $this->_number;
    }

    public function setNumber(?int $number): void
    {
        $this->_number = $number;
    }
}
