<?php

namespace App\Lib;

class Router
{
    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function on($pattern, $callback)
    {
        $path = $_SERVER['REQUEST_URI'];
        $pattern = '@^' . $pattern . '$@';

        if (preg_match($pattern, $path, $args)) {
            array_shift($args);
            $request = new Request();
            $response = new Response();

            return call_user_func_array($callback, array($request, $response, $args));
        }
    }
}
