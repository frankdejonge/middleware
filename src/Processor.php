<?php

namespace FrankDeJonge\Middleware;

interface Processor
{
    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload);
}