<?php

return [
    'parent'=> 'parent_id',
    'username' => 'username' ,
    'primary_key' => 'id',
    'childNode' => 'children',
    'body' => [
        'id',
        'username',
        'position',
        'sponsor_id',
        'pv',
        'pv_left' => 0,
        'pv_midle' => 0,
        'pv_right' => 0,
        'rank_id',
    ]
];
