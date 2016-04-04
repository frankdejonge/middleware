<?php

namespace FrankDeJonge\Middleware;

class MiddlewareBuilder implements Processor
{
    /**
     * @var Middleware[]
     */
    protected $stack = [];

    /**
     * @param Middleware $handler
     *
     * @return $this
     */
    public function stack(Middleware $handler)
    {
        $this->stack[] = $handler;

        return $this;
    }

    /**
     * @return ExecutionChain
     */
    public function buildExecutionChain()
    {
        return new ExecutionChain($this->stack);
    }

    /**
     * @param $payload
     *
     * @return mixed
     */
    public function process($payload)
    {
        return $this->buildExecutionChain()->process($payload);
    }
}