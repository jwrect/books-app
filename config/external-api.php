<?php

return [
    'books-api' => [
        'version' => env('BOOKS_API_VERSION', 'v3'),
        'endpoint' => env('BOOKS_API_ENDPOINT', 'https://api.nytimes.com/svc/books/'),
        'api_key' => env('BOOKS_API_KEY', ''),
    ]
];
