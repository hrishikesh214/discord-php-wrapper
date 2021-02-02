<?php 

require_once 'linker.php';

class Message{
	public $content;
	public $nounce;
	public $tts;
	public $file;
	public $embed;
	public $payload_json;
	public $allowed_mentions;
	public $message_reference;

	public function __construct($obj){
		set_properties($this, $obj, ['content', 'nounce', 'tts', 'file', 'payload_json', 'allowed_mentions']);
		$this->embed = get_object($obj, 'embed', 'Embed');
		$this->embed = get_object($obj, 'message_reference', 'MessageRefrence');
	}

	public function json(){
		return json_encode($this);
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