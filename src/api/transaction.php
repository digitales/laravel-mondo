<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Transaction extends Client
{
    protected $apiUrl = 'https://api.getmondo.co.uk/transactions';
    
    public function __construct($token, $refreshToken = null, $client = null)
    {
        parent::__construct($token, $refreshToken, $client);
    }
    
    
    public function get( $transactionId = null )
    {
        return $this->get( $this->apiUrl.'/'.$transactionId );   
    }
    
    
    public function whoami()
    {
        return $this->get('https://api.getmondo.co.uk/ping/whoami');
    }
    
    
    public function getList( $accountId )
    {
        return $this->get( $this->apiUrl, ['account_id' => $accountId ]); 
    }
    
    
    public function annotate( $transactionId, $annotationPayload )
    {
        return $this->patch( $this->apiUrl.'/'.$transactionId, $annotationPayload ); 
    }
    
}