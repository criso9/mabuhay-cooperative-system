<?php
return [
    'admin_auth' => env('LARAPOLL_ADMIN_AUTH_MIDDLEWARE', 'admin'),
    'pagination' => env('LARAPOLL_PAGINATION', 10),
    'prefix' => env('LARAPOLL_PREFIX', 'admin')
];