<?php

namespace Digitales;

use GuzzleHttp\ClientInterface;

use Digitales\LaravelMondo\AbstractProvider;
use Digitales\LaravelMondo\Api\Account;
use Digitales\LaravelMondo\Api\Transaction;
use Digitales\LaravelMondo\Api\Webhook;
use Digitales\LaravelMondo\Api\Feed;

class LaravelMondo extends AbstractProvider
{
    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [ ];


    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://auth.getmondo.co.uk/', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://api.getmondo.co.uk/oauth2/token';
    }

    /**
     * Get the access token for the given code.
     *
     * @param  string  $code
     * @return string
     */
    public function getAccessToken($code)
    {
        $postKey = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';

        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            $postKey => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        return $this->user()->whoami();
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'], 'nickname' => array_get($user, 'nickname'), 'name' => $user['displayName'],
            'email' => $user['emails'][0]['value'], 'avatar' => array_get($user, 'image')['url'],
        ]);
    }
    
    
    /**
     * Transaction methods
     *
     * @param string $token || null The user's authentication token
     * @param string $refreshToken || null The user's authentication refresh token
     * @param $client || null
     *
     * @return object Digitales\LaravelMondo\Api\Transaction
     */
    public function transaction( $token = null, $refreshToken = null, $client = null)
    {
        $userToken = (!$token) ? $this->token : $token;
        
        
        return Transaction( $token, $refreshToken, $client );    
    }
    
    
    /**
     * Account methods
     *
     * @param string $token || null The user's authentication token
     * @param string $refreshToken || null The user's authentication refresh token
     * @param $client || null
     *
     * @return object Digitales\LaravelMondo\Api\Account
     */
    public function account( $token = null, $refreshToken = null, $client = null )
    {
        return Account( $token, $client );
    }
    
    /**
     * Webhook methods
     *
     * @param string $token || null The user's authentication token
     * @param string $refreshToken || null The user's authentication refresh token
     * @param $client || null
     *
     * @return object Digitales\LaravelMondo\Api\Webhook
     */
    public function webhook( $token = null, $refreshToken = null, $client = null )
    {
        return Webhook( $token, $client );
    }

    
    /**
     * Feed methods
     *
     * @param string $token || null The user's authentication token
     * @param string $refreshToken || null The user's authentication refresh token
     * @param $client || null
     *
     * @return object Digitales\LaravelMondo\Api\Feed
     */
    public function feed( $token = null, $refreshToken = null, $client = null )
    {
        return Feed( $token, $client );
    }
    
    
    
}