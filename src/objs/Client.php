<?php
namespace Discord;
require_once __dir__.'/../linker.php';
use GuzzleHttp\Psr7\Request;
use Discord\Guild;

class Client{
	protected $token;
	private $guzzle;
	private $headers;

	public function __construct($token){
		global $base_api, $default_headers;
		$this->token = $token;
		$this->guzzle = new \GuzzleHttp\Client([
			'base_uri' => 'https://discord.com/api/'
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

	public function filter_textchannels($channels){
		$tchannels = array();
		foreach( $channels as $channel ){
			if( $channel['type'] == 0 ){
				array_push($tchannels, $channel);
			}
		}
		return $tchannels;
	}

	public function __destruct(){
	    unset($this->guzzle);
    }
	
}