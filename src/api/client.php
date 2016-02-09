<?php
namespace Digitales\LaravelMondo\Api;

use GuzzleHttp\ClientInterface;

class Client {
    
    protected $HttpClient;
    
    protected $headers;
    
    protected $token;
    
    protected $refreshToken;
    
    protected $apiUrl;
    
    protected $clientId;
    
    protected $clientSecret;
    
    public function __construct( $token = null, $refreshToken, $client = null, $clientId = null, $clientSecret = null )
    {
        $this->token = $token;
        $this->refreshToken = $refreshToken;
        $this->httpClient = $client;
        
        $this->setClientId( $clientId );
        $this->setClientSecret( $clientSecret );
    }
    
    
    public function setApiUrl( $url )
    {
        $this->apiUrl = $url;
        return $this;
    }
    
    
    public function getApiUrl()
    {
        return $this->apiUrl;
    }
    
    public function setClientId( $clientId )
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    
    public function getClientId()
    {
        return $this->clientId;
    }
    
    public function setClientSecret( $clientSecret )
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
    
    
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
    
    
    /**
     *  Get a fresh instance of the Guzzle HTTP client.
     *
     *  @param boolean $forceNew Force a new instance of the http client
     *  
     *  @return \GuzzleHttp\Client
     */
    protected function getHttpClient( $forceNew = false)
    {
        if (!$this->httpClient && false == $forceNew ) {
            $this->httpClient = new \GuzzleHttp\Client;
        }
        
        return $this->httpClient;
    }
    
    
    protected function assembleHeaders( $excludeAuth = false )
    {
        $headers =  [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$this->getToken(),
                    ];
        
        if (true == $excludeAuth){
            unset($headers['Authorization']);
        }
        
        return $headers;
    }
    
    
    protected function getToken()
    {
        return $this->token;
    }
    
    
    
    public function getAction( $requestUrl, $payload = null, $token = null )
    {
        $postKey = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';
        
        $query = null;
        
        if (isset($payload) ){
            $query = $payload;
        }
        
        $response = $this->getHttpClient()->get( $requestUrl, [
            'headers' => $this->assembleHeaders(),
            'query' => $query,
        ]);

        return json_decode($response->getBody(), true);
    }
    
    
    
    public function postAction( $requestUrl, $payload, $excludeAuthorization = false )
    {
        $headers = $this->assembleHeaders($excludeAuthorization);

        $postKey = (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';
        
        $response = $this->getHttpClient()->post($requestUrl, [
            'headers' => $headers,
            $postKey => $payload,
        ]);
    
        return json_decode($response->getBody(), true );    
    }
    
    
    public function deleteAction( $requestUrl, $payload )
    {
        $headers = $this->assembleHeaders();
        
    }
    
    public function putAction( $requestUrl, $payload )
    {
        $headers = $this->assembleHeaders();
        
    }
    
    public function patchAction( $requestUrl, $payload )
    {
        $headers = $this->assembleHeaders();
        
    }
    
}
