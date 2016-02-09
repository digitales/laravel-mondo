<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Account extends Client
{
    protected $apiBaseUrl = 'https://api.getmondo.co.uk';
    
    
    public function get( $accountId = null )
    {    
        return $this->getAction( $this->apiBaseUrl.'/accounts', ['account' => $accountId] );   
    }
    
    public function whoAmI()
    {
        return $this->getAction( $this->apiBaseUrl.'/ping/whoami' );
    }
    
    
    public function balance( $accountId )
    {
        return $this->getAction( $this->apiBaseUrl.'/balance', ['account_id' => $accountId] ); 
    }
    
    
    public function refreshToken( $refreshToken = null )
    {
        if (!$refreshToken){
            $refreshToken = $this->refreshToken;
        }
        
        $payload = [
                    'grant_type' => 'refresh_token',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'refresh_token' => $refreshToken
                ];
        
        return $this->postAction( 'https://api.getmondo.co.uk/oauth2/token', $payload, true );          
    }
    
}