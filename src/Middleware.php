<?php

namespace FrankDeJonge\Middleware;

use Closure;

interface Middleware
{
    /**
     * @param mixed   $payload
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($payload, Closure $next);
}