<?php

namespace Digitales\LaravelMondo\Contracts;

interface Provider
{
    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect();

    /**
     * Get the User instance for the authenticated user.
     *
     * @return \Digitales\LaravelMondo\Contracts\User
     */
    public function user();
}
