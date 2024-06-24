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

    public function toString(): string
    {
        $parts = [];

        foreach ($this->_entity as $entity)
        {
            $parts[] = $entity->toString();
        }

        return implode(
            PHP_EOL,
            $parts
        );
    }
}