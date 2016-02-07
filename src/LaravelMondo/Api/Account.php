<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Account extends Client
{
    protected $apiBaseUrl = 'https://api.getmondo.co.uk';
    
    
    public function get( $accountId = null )
    {
        return $this->get( $this->apiBaseUrl.'/accounts', ['account' => $account] );   
    }
    
    public function whoami()
    {
        return $this->get( $this->apiBaseUrl.'/ping/whoami');
    }
    
    
    public function balance( $accountId )
    {
        return $this->get( $this->apiBaseUrl.'/balance', ['account_id' => $accountId] ); 
    }
    
}