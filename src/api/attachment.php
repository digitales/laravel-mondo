<?php
namespace Digitales\LaravelMondo\Api;

use Digitales\LaravelMondo\Api\Client;

class Attachment extends Client
{
    protected $apiUrl = 'https://api.getmondo.co.uk/attachment';

	public function preUpload( $fileName, $fileType )
	{
		$payload = [ 'file_name' => $fileName, 'file_type' => $fileType ];
		
		return $this->postAction( $this->apiUrl.'/upload', $payload );
	}
	
	
	public function uploadFile( $uploadUrl, $filePath )
	{
		$payload = [ 'file' => $filePath ];
		
		return $this->postAction( $uploadUrl, $payload, true );
	}
	
	
	public function register( $transactionId, $fileUrl, $fileType )
	{
		$payload = ['external_id' => $transactionId, 'file_url' => $fileUrl, 'file_type' => $fileType ];
		
		return $this->postAction( $this->apiUrl.'/register', $payload );
	}
	
	public function deregsiter( $attachmentId )
	{
		$payload = ['id' => $attachmentId ];
		
		return $this->postAction( $this->apiUrl.'/deregister', $payload );
	}

}