<?php

namespace FrankDeJonge\Middleware;

use Closure;

class ExecutionChain implements Processor
{
    /**
     * @var Closure
     */
    protected $chain;

    /**
     * @param Middleware[] $middlewareStack
     */
    public function __construct(array $middlewareStack)
    {
        $this->chain = $this->createExecutionChain(...$middlewareStack);
    }

    /**
     * @param $payload
     *
     * @return mixed
     */
    public function process($payload)
    {
        $chain = $this->chain;

        return $chain($payload);
    }

    /**
     * Create the nested execution chain.
     *
     * @param Middleware[] $middlewareStack
     *
     * @return Closure
     */
    private function createExecutionChain(Middleware ...$middlewareStack)
    {
        $next = function ($payload) { return $payload; };

        foreach ($middlewareStack as $middleware) {
            $next = function ($payload) use ($next, $middleware) {
                return $middleware->handle($payload, $next);
            };
        }

        return $next;
    }
}