<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActive')) {
    function isActive($key, $activeClassName = 'menu-active')
    {
        if (is_array($key)) {
            return in_array(Route::currentRouteName(), $key, true) ? $activeClassName : '';
        }
        return Route::currentRouteName() == $key ? $activeClassName : '';
    }
}
