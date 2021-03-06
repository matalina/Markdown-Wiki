<?php

use Mni\FrontYAML\Parser;
use App\Index;

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
    $indices = Index::with('page')->get();

    foreach($indices as $i) {
        $url = './#/page/'.str_replace('.md','',$i->page->location);
        $page = "[$1]($url)";
        $markdown = preg_replace("/({$i->index})/i", $page, $markdown, 1);
    }

    return $markdown;
}