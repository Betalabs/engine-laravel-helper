<?php

return [
    'resources' => [
        'Creator',
        'Destroyer',
        'Updater',
        'Indexer',
        'Shower',
    ],
    'endpoints' => [
        'Betalabs\LaravelHelper\Services\Engine\Channel' => 'channels',
        'Betalabs\LaravelHelper\Services\Engine\Form' => 'forms',
        'Betalabs\LaravelHelper\Services\Engine\ExtraField' => 'extra-fields',
        'Betalabs\LaravelHelper\Services\Engine\ExtraFieldType' => 'extra-field-types',
        'Betalabs\LaravelHelper\Services\Engine\FormExtraField' => 'forms/{formId}/extra-fields',
        'Betalabs\LaravelHelper\Services\Engine\Entity' => 'entities'
    ]
];