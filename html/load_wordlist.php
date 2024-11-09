<?php

require __DIR__ . '/../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()
    ->setHosts(['elasticsearch:9200'])
    ->build();

$words = file('elasticsearch-wordlist.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($words as $word) {
    $params = [
        'index' => 'autocomplete_words',
        'body'  => [
            'word' => $word
        ]
    ];
    try {
        $client->index($params);
    } catch (Exception $e) {
        echo "Error indexing word '$word': " . $e->getMessage() . "\n";
    }
}

echo "Wordlist indexed successfully.\n";