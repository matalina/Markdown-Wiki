<?php

use Mni\FrontYAML\Parser;

function parseFile($contents)
{
    $parser = new Parser();

    $document = $parser->parse($contents, false);

    $yaml = $document->getYAML();
    $markdown = $document->getContent();

    $page = wikiLinks($markdown);

    $data = [
        'meta' => $yaml,
        'content' => $page,
    ];

    return $data;
}

function wikiLinks($markdown)
{
    return $markdown;
}