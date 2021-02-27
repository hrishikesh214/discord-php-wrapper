<?php 

namespace Discord;
require_once __dir__.'/../linker.php';
use \GuzzleHttp\RequestOptions;
use Discord\Utils\{Embed};

class Channel{
	private $token;
	private $guzzle;
	private $headers;
	public $id;
	public $name;
	public $type;
	public $guild_id;
	public $topic;
	public $nsfw;
	public $permission_overwrites;
	public $last_message_id;
	public $parent_id;
	public $rate_limit_per_user;
	public $position;


	public function __construct($obj){
		global $token;
		$this->token = $token;
		global $base_api;
		$this->guzzle = new \GuzzleHttp\Client([
			'base_uri' => $base_api
		]);
		$this->headers = array(
			'Accept'=> 'application/json',
			'Authorization' => 'Bot '.$this->token
		);
		set_properties($this, $obj, ['id', 'name', 'type', 'guild_id', 'topic', 'nsfw', 'permission_overwrites', 'last_message_id', 'parent_id', 'rate_limit_per_user', 'position']);
	}

    public function __destruct(){
        unset($this->guzzle);
    }

	public function json(){
		return json_encode($this);
	}

	public function get_message($id = NULL){
		if( $id != NULL ){
			$link = 'channels/'.$this->id.'/messages/'.$id;
			$res = $this->guzzle->request('GET', $link, ['headers' => $this->headers]);
			return new Message(json_decode($res->getBody()));
		}
		else{
			$link = 'channels/'.$this->id.'/messages';
			$res = $this->guzzle->request('GET', $link, ['headers' => $this->headers]);
			foreach(json_decode($res->getBody()) as $m){
				$messages[] = new Message($m);
			}
			return $messages;
		}
	}

	public function send($message = NULL, Embed $embed = NULL){
		$link = 'channels/'.$this->id.'/messages';
		$headers = $this->headers;
		$headers['Content-Type'] = 'application/json';
		if($message != NULL && is_string($message)){
			$message = new Message(data:['content' => $message]);
		}
		else if($embed != NULL){
			$message = new Message(data:['embed' => json_decode(json_encode($embed), 1)]);
		}
		// debug($message->json());
		// die();
		$res = $this->guzzle->request('POST', $link, [
				'headers' => $headers,
				'body' => $message->json()

			]);
		return new Message(json_decode($res->getBody()));
	}

}