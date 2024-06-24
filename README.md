# gemtext-php

PHP 8 library for `text/gemini`

This library is lightweight, object-oriented [Gemtext](https://geminiprotocol.net/docs/gemtext.gmi) replacement to [gemini-php](https://github.com/YGGverse/gemini-php)

## Install

``` bash
composer require yggverse/gemtext:dev-main
```

## Examples

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

### Make new document

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

// Append link to document
$document->append(
    $link
);

// Get gemtext result
print(
    $document->toString()
);

// Save to file
file_put_contents(
    '/path/to/file.gmi',
    $document->toString()
)
```