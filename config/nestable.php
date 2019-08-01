<?php

return [
    'parent'=> 'parent_id',
    'name_name' => 'first_name' ,
    'primary_key' => 'id',
    'generate_url'   => true,
    'childNode' => 'children',
    'body' => [
        'id',
        'first_name',
        'position',
        'sponsor_id',
    ],
    'html' => [],
    'dropdown' => []
];
