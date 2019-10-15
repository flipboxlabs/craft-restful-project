<?php

return [
    // Global settings
    '*' => [
        'authMethods' => [
            \flipbox\craft\jwt\filters\JwtHttpBearerAuth::class
        ]
    ]
];
