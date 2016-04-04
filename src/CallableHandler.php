<?php

namespace FrankDeJonge\Middleware;

use Closure;

class CallableHandler implements Middleware
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param mixed   $payload
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($payload, Closure $next)
    {
        $callable = $this->callable;

        return $callable($payload, $next);
    }
}