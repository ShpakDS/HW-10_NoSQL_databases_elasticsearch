<?php
require __DIR__ . '/../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->setHosts(['elasticsearch:9200'])->build();

$indexParams = [
    'index' => 'autocomplete_words',
    'body'  => [
        'settings' => [
            'analysis' => [
                'tokenizer' => [
                    'my_tokenizer' => [
                        'type' => 'edge_ngram',
                        'min_gram' => 1,
                        'max_gram' => 25,
                        'token_chars' => ['letter', 'digit']
                    ]
                ],
                'filter' => [
                    'lowercase' => [
                        'type' => 'lowercase'
                    ]
                ],
                'analyzer' => [
                    'my_analyzer' => [
                        'type' => 'custom',
                        'tokenizer' => 'my_tokenizer',
                        'filter' => ['lowercase']
                    ]
                ]
            ]
        ],
        'mappings' => [
            'properties' => [
                'word' => [
                    'type' => 'text',
                    'analyzer' => 'my_analyzer'
                ]
            ]
        ]
    ]
];

try {
    $client->indices()->create($indexParams);
    echo "Index created successfully.\n";
} catch (Exception $e) {
    echo "Error creating index: " . $e->getMessage() . "\n";
}