<?php

return [
    'BASE' => [
        'base' => [
            'test' => false,// nem futnal le a construktorbsn meeghívott funkciók, automatizmusok
            'allowedTask' => ['index', 'create', 'store', 'edit', 'update', 'show', 'pub', 'unpub', 'destroy'], //store:POST,update: PUT/PACH,destroy:delete
        ],
    ],
    'PAR' => [
        'base' => [
            'template' => 'Bootstrap3.dashgum',
            'baseTask' => 'index',
            'baseViewTask' =>  'index',

        ],
    ],
];
