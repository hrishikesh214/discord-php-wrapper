<?php 
require_once 'linker.php';
use GuzzleHttp\Psr7\Request;

class Discord{

	public function __construct(public $token){
		global $base_api, $default_headers;
		$this->guzzle = new GuzzleHttp\Client([
			'base_uri' => $base_api
		]);
		$this->headers = array(
			'Accept'=> 'application/json',
			'Authorization' => 'Bot '.$this->token
		);;
	}

	public function get_guild($id){
		$link = 'guilds/'.$id;
		$res = $this->guzzle->request('GET', $link, ['headers' => $this->headers]);
		return new Guild(json_decode($res->getBody()));
	}
	
}