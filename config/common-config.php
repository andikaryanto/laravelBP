<?php

return [
    'entity' => [
        'mapping' => [
            'app' => base_path() . '/app/Entities/Mapping'
        ]
    ],
    'jwt' => [
        'expired_in_days' => 90
    ],
    'collection_paging' => [
        'size' => 25
    ],
    'env' => [
        'local' => [
            'rollbar_access_token' => '70bcd36f122549e1be69305e84050e5c',
        ],
        'test' => [
            'rollbar_access_token' => '70bcd36f122549e1be69305e84050e5c',
        ],
        'staging' => [
            'rollbar_access_token' => '70bcd36f122549e1be69305e84050e5c',
        ],
        'production' => [
            'rollbar_access_token' => '70bcd36f122549e1be69305e84050e5c',
        ]
    ]
];
