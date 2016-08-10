<?php

return [
	'ADMIN' => 1,
	'SUP' => 2,
	'USER' => 3,
    'size' => 5,
    'status' => [
        0 => 'Created',
        1 => 'In Progress',
        2 => 'Pending',
        3 => 'Finish',
    ],
    'action_type' => [
        'create' => 0,
        'update' => 1,
        'delete' => 2,
        'join' => 3,
        'finish' => 4,
        'start' => 5,
    ],
];