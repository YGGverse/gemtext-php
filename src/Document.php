<?php

declare(strict_types=1);

namespace Yggverse\Gemtext;

use \Yggverse\Gemtext;

class Document
{
    private array $_entity = [];

    public function __construct(
        string $data
    ) {
        foreach ((array) explode(PHP_EOL, $data) as $line)
        {
            // Add entity
            switch (true)
            {
                // Code
                case Parser\Code::match($line):

                    $this->_entity[] = new Entity\Code(
                        Parser\Code::getAlt(
                            $line
                        ),
                        Parser\Code::isInline(
                            $line
                        )
                    );

                break;

                // Header
                case Parser\Header::match($line):

                    $this->_entity[] = new Entity\Header(
                        Parser\Header::getText(
                            $line
                        ),
                        Parser\Header::getLevel(
                            $line
                        )
                    );

                break;

                // Link
                case Parser\Link::match($line):

                    $this->_entity[] = new Entity\Link(
                        Parser\Link::getAddress(
                            $line
                        ),
                        Parser\Link::getAlt(
                            $line
                        ),
                        Parser\Link::getDate(
                            $line
                        )
                    );

                break;

                // Listing
                case Parser\Listing::match($line):

                    $this->_entity[] = new Entity\Listing(
                        Parser\Listing::getItem(
                            $line
                        )
                    );

                break;

                // Quote
                case Parser\Quote::match($line):

                    $this->_entity[] = new Entity\Quote(
                        Parser\Quote::getText(
                            $line
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