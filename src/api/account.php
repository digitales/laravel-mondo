<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Account extends Client
{
    protected $apiBaseUrl = 'https://api.getmondo.co.uk';
    
    
    public function get( $accountId = null )
    {    
        return $this->getAction( $this->apiBaseUrl.'/accounts', ['account' => $account] );   
    }
    
    public function whoAmI()
    {
        return $this->getAction( $this->apiBaseUrl.'/ping/whoami');
    }
    
    
    public function balance( $accountId )
    {
        return $this->getAction( $this->apiBaseUrl.'/balance', ['account_id' => $accountId] ); 
    }
    
}