<?php

declare(strict_types=1);

namespace Yggverse\Gemtext;

use \Yggverse\Gemtext;

class Document
{
    private array $_entities = [];

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

                    $this->_entities[] = new Entity\Code(
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

                    $this->_entities[] = new Entity\Header(
                        Parser\Header::getLevel(
                            $line
                        ),
                        Parser\Header::getText(
                            $line
                        )
                    );

                break;

                // Link
                case Parser\Link::match($line):

                    $this->_entities[] = new Entity\Link(
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

                    $this->_entities[] = new Entity\Listing(
                        Parser\Listing::getItem(
                            $line
                        )
                    );

                break;

                // Quote
                case Parser\Quote::match($line):

                    $this->_entities[] = new Entity\Quote(
                        Parser\Quote::getText(
                            $line
                        )
                    );

                break;

                // Plain
                default:

                    $this->_entities[] = new Entity\Text(
                        $line
                    );
            }
        }
    }

    public function toString(): string
    {
        $entities = [];

        foreach ($this->_entities as $entity)
        {
            $entities[] = $entity->toString();
        }

        return implode(
            PHP_EOL,
            $entities
        );
    }
}