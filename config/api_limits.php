<?php

return [
    'google' => [
        'max_attempts' => 100,
        'decay_minutes' => 1,
    ],
    'facebook' => [
        'max_attempts' => 60,
        'decay_minutes' => 1,
    ],
    'default' => [
        'max_attempts' => 60,
        'decay_minutes' => 1,
    ],
];
