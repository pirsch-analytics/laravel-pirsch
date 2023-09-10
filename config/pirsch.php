<?php

return [
    'token'           => env('PIRSCH_TOKEN'),
    // If you wish you exclude dashboard routes, you'd add dashboard/
    'excluded_routes' => [
        'telescope/',
        'horizon/'
        // 'dashboard/'.
    ],
];
