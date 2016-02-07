<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Feed extends Client
{
    protected $apiUrl = 'https://api.getmondo.co.uk/feed';    
    
    public function create( $accountId, $payload )
    {
        $payload['account_id'] = $accountId;
        
        return $this->post( $this->apiUrl, $payload );   
    }    
}