<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Transaction extends Client
{
    protected $apiUrl = 'https://api.getmondo.co.uk/transactions';
    
    public function get( $transactionId = null )
    {
        return $this->getAction( $this->apiUrl.'/'.$transactionId );   
    }
    
    
    public function whoami()
    {
        return $this->getAction('https://api.getmondo.co.uk/ping/whoami');
    }
    
    
    public function getList( $accountId )
    {
        return $this->getAction( $this->apiUrl, ['account_id' => $accountId ]); 
    }
    
    
    public function annotate( $transactionId, $annotationPayload )
    {
        return $this->patchAction( $this->apiUrl.'/'.$transactionId, $annotationPayload ); 
    }
    
}