<?php

namespace Digitales\LaravelMondo\Contracts;

interface User
{
    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getId();
    
    /**
     * Get the client ID for the current user
     *
     * @return string
     */
    public function getClientId();

}
