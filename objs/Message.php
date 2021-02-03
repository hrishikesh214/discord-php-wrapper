<?php 

require_once __dir__.'/../linker.php';

class Message{
	private $token;
	private $guzzle;
	private $headers;
	public $content;
	public $id;
	public $nounce;
	public $tts;
	public $channel_id;
	public $file;
	public $embed;
	public $payload_json;
	public $allowed_mentions;
	public $message_reference;
	public $timestamp;
	public $author;

	public function __construct($obj=NULL, $data = NULL){
		global $token;
		$this->token = $token;
		global $base_api;
		$this->guzzle = new GuzzleHttp\Client([
			'base_uri' => $base_api
		]);
		$this->headers = array(
			'Accept'=> 'application/json',
			'Authorization' => 'Bot '.$this->token
		);
		if($obj != NULL){ $this->set($obj); }
		else if($data !=NULL){
			$this->set(json_decode(json_encode($data)));
		}
		else{
			$this->set(new stdClass());
		}
	}

	private function set($obj){
		set_properties($this, $obj, ['id','content', 'channel_id', 'nounce', 'tts', 'file', 'payload_json', 'allowed_mentions', 'timestamp']);
		$this->embed = get_object($obj, 'embed', 'Embed');
		$this->embeds = get_object($obj, 'embeds', 'Embed');
		$this->message_reference = get_object($obj, 'message_reference', 'MessageRefrence');
		$this->author = get_object($obj, 'author', 'User');
	}

	public function json(){
		$final = (object)array_filter((array)$this);
		return json_encode($final);
	}

	public function edit($embed = NULL, $content = NULL){
		$link = 'channels/'.$this->channel_id.'/messages/'.$this->id;
		$headers = $this->headers;
		$headers['Content-Type'] = 'application/json';
		if($embed != NULL){
			$message = new Message(data:['embed' => json_decode(json_encode($embed), 1)]);
		}
		else if($content != NULL && is_string($content)){
			$message = new Message(data:['content' => $content]);
		}
		$res = $this->guzzle->request('PATCH', $link, [
				'headers' => $headers,
				'body' => $message->json()

			]);
		$this->set($message);
		$this->id = $message->id;
	}

	public function delete(){
		$link = 'channels/'.$this->channel_id.'/messages/'.$this->id;
		$headers = $this->headers;
		$headers['Content-Type'] = 'application/json';
		$res = $this->guzzle->request('DELETE', $link, [
				'headers' => $headers
			]);
	}
}

class MessageRefrence{
	public $message_id;
	public $channel_id;
	public $guild_id;

	public function __construct($obj){
		set_properties($this, $obj, ['message_id', 'channel_id', 'guild_id']);
	}

}