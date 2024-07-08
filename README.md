# gemtext-php

Lightweight, object-oriented PHP 8 library for [Gemini](https://geminiprotocol.net) / [Gemtext](https://geminiprotocol.net/docs/gemtext.gmi) operations

## See also

* [gemini-php](https://github.com/YGGverse/gemini-php) - PHP 8 Client library for Gemini protocol connections

## Integrations

* [gemini-dl](https://github.com/YGGverse/gemini-dl) - CLI batch downloader for Gemini protocol
* [Yoda](https://github.com/YGGverse/Yoda) - PHP-GTK Browser for Gemini protocol

## Install

``` bash
composer require yggverse/gemtext
```

## Example

### Parse existing document

``` php
// Load document from file
$document = new \Yggverse\Gemtext\Document(
    file_get_contents(
        'tests/data/document.gmi'
    )
);

// Get links
foreach ($document->getLinks() as $link)
{
    print(
        $link->toString()
    );
}
```

### Create new document

``` php
// Init new document
$document = new \Yggverse\Gemtext\Document;

// Append header
$document->append(
    new \Yggverse\Gemtext\Entity\Header(
        'Hello world'
    )
);

// Init new link
$link = new \Yggverse\Gemtext\Entity\Link(
    'gemini://geminiprotocol.net',
    'The Gemini Program',
    '1965-01-19'
);

// Change link date
$link->setDate(
    date('Y-m-d')
);

// Append link
$document->append(
    $link
);

// Get gemtext
print(
    $document->toString()
);

// Save to file
file_put_contents(
    '/path/to/file.gmi',
    $document->toString()
)
```