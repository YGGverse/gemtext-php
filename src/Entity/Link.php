<?php

declare(strict_types=1);

namespace Yggverse\Gemtext\Entity;

class Link
{
    public const TAG = '=>';

    private string $_address;

    private ?string $_alt;
    private ?string $_date;

    public function __construct(
         string $address,
        ?string $alt = null,
        ?string $date = null
    ) {
        $this->setAddress(
            $address
        );

        $this->setAlt(
            $alt
        );

        $this->setDate(
            $date
        );
    }

    public function setAddress(
        string $address
    ): void
    {
        $address = trim(
            $address
        );

        if (empty($address))
        {
            throw new \Exception(
                _('Address required')
            );
        }

        $this->_address = $address;
    }

    public function getAddress(): string
    {
        return $this->_address;
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

    public function setDate(
        ?string $date
    ): void
    {
        if ($date)
        {
            $date = trim(
                $date
            );

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date))
            {
                throw new \Exception(
                    _('Date does not match format YYYY-MM-DD')
                );
            }
        }

        $this->_date = $date;
    }

    public function getDate(): ?string
    {
        return $this->_date;
    }

    public function toString(): string
    {
        $parts = [
            self::TAG,
            $this->getAddress()
        ];

        if ($date = $this->getDate())
        {
            $parts[] = $date;
        }

        if ($alt = $this->getAlt())
        {
            $parts[] = $alt;
        }

        return implode(
            ' ',
            $parts
        );
    }
}