<?php

use FrankDeJonge\Middleware\CallableHandler;
use FrankDeJonge\Middleware\MiddlewareBuilder;

include __DIR__.'/vendor/autoload.php';

$result = ((new MiddlewareBuilder)
    ->stack(new CallableHandler(function ($message, Closure $next) {
        var_dump('1 before '.$message);
        $message = $next($message + 1);
        var_dump('1 after '.$message);

        return $message - 1;
    }))
    ->stack(new CallableHandler(function ($message, Closure $next) {
        var_dump('2 before '.$message);
        $message = $next($message + 1);
        var_dump('2 after '.$message);

        return $message - 1;
    }))
    ->process(0));
