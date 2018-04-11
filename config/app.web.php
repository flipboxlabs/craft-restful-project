<?php

$config = [
    'modules' => [
        'v1' => \modules\rest\v1\V1::class
    ],
    'bootstrap' => ['v1']
];

if (!defined('REST')) {
    return $config;
}

return \craft\helpers\ArrayHelper::merge(
    $config,
    require(dirname(__DIR__).'/vendor/flipboxfactory/craft-rest/config/rest.php')
);