<?php

require __DIR__ . '/../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->setHosts(['elasticsearch:9200'])->build();

echo "Input search query: ";
$searchWord = trim(fgets(STDIN));

$params = [
    'index' => 'autocomplete_words',
    'body'  => [
        'query' => [
            'fuzzy' => [
                'word' => [
                    'value' => $searchWord,
                    'fuzziness' => 'AUTO',
                    'max_expansions' => 50,
                    'prefix_length' => 2
                ]
            ]
        ],
        'size' => 10,
    ]
];

$response = $client->search($params);

if (isset($response['hits']['hits'])) {
    foreach ($response['hits']['hits'] as $key => $hit) {
        echo ($key + 1) . ". " . $hit['_source']['word'] . "\n";
    }
} else {
    echo "Nothing found\n";
}