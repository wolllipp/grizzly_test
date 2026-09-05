<?php

return [
    'db' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: '5432',
        'name' => getenv('DB_NAME') ?: 'testdb',
        'user' => getenv('DB_USER') ?: 'testuser',
        'password' => getenv('DB_PASSWORD') ?: 'testpassword',
    ],
];
