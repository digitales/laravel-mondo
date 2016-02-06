<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;


class Webhook extends Client
{
    protected $apiUrl = 'https://api.getmondo.co.uk/webhooks';

    public function create( $accountId, $webhookUrl )
    {
        $payload = [ 'account_id' => $accountId, 'url' => $webhookUrl ];
        
        return $this->post( $this->apiUrl, $payload );   
    }
    
    public function getList( $accountId )
    {
        return $this->get( $this->apiUrl.'?account_id'. $accountId); 
    }
    
    public function remove( $webhookId )
    {
        return $this->delete( $this->apiUrl.'/'.$webhookId ); 
    }
    
}