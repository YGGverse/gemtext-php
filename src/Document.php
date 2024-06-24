<?php

declare(strict_types=1);

namespace Yggverse\Gemtext;

use \Yggverse\Gemtext;

class Document
{
    private array $_entity = [];

    public function __construct(
        string $data = ''
    ) {
        foreach ((array) explode(PHP_EOL, $data) as $line)
        {
            // Init match
            $matches = [];

            // Add entity
            switch (true)
            {
                // Code
                case Parser\Code::match($line, $matches):

                    $this->_entity[] = new Entity\Code(
                        Parser\Code::getAlt(
                            $line,
                            $matches
                        ),
                        Parser\Code::isInline(
                            $line,
                            $matches
                        )
                    );

                break;

                // Header
                case Parser\Header::match($line, $matches):

                    $this->_entity[] = new Entity\Header(
                        Parser\Header::getText(
                            $line,
                            $matches
                        ),
                        Parser\Header::getLevel(
                            $line,
                            $matches
                        )
                    );

                break;

                // Link
                case Parser\Link::match($line, $matches):

                    $this->_entity[] = new Entity\Link(
                        Parser\Link::getAddress(
                            $line,
                            $matches
                        ),
                        Parser\Link::getAlt(
                            $line,
                            $matches
                        ),
                        Parser\Link::getDate(
                            $line,
                            $matches
                        )
                    );

                break;

                // Listing
                case Parser\Listing::match($line, $matches):

                    $this->_entity[] = new Entity\Listing(
                        Parser\Listing::getItem(
                            $line,
                            $matches
                        )
                    );

                break;

                // Quote
                case Parser\Quote::match($line, $matches):

                    $this->_entity[] = new Entity\Quote(
                        Parser\Quote::getText(
                            $line,
                            $matches
                        )
                    );

                break;

                // Plain
                default:

                    $this->_entity[] = new Entity\Text(
                        $line
                    );
            }
        }
    }

    public function getEntities(): array
    {
        return $this->_entity;
    }

    public function getHeaders(): array
    {
        $headers = [];

        foreach ($this->_entity as $entity)
        {
            if ($entity instanceof Entity\Header)
            {
                $headers[] = $entity;
            }
        }

        return $headers;
    }

    public function getLinks(): array
    {
        $links = [];

        foreach ($this->_entity as $entity)
        {
            if ($entity instanceof Entity\Link)
            {
                $links[] = $entity;
            }
        }

        return $links;
    }

    public function getListings(): array
    {
        $listings = [];

        foreach ($this->_entity as $entity)
        {
            if ($entity instanceof Entity\Listing)
            {
                $listings[] = $entity;
            }
        }

        return $listings;
    }

    public function getQuotes(): array
    {
        $quotes = [];

        foreach ($this->_entity as $entity)
        {
            if ($entity instanceof Entity\Quote)
            {
                $quotes[] = $entity;
            }
        }

        return $quotes;
    }

    public function append(
        \Yggverse\Gemtext\Interface\Entity $entity
    ): void
    {
        $this->_entity[] = $entity;
    }

    public function toString(): string
    {
        $lines = [];

        foreach ($this->_entity as $entity)
        {
            $lines[] = $entity->toString();
        }

        return implode(
            PHP_EOL,
            $lines
        );
    }
}