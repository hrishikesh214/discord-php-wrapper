<?php 

require_once 'linker.php';

class Channel extends Discord{
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
		set_properties($this, $obj, ['id', 'name', 'type', 'guild_id', 'topic', 'nsfw', 'permission_overwrites', 'last_message_id', 'parent_id', 'rate_limit_per_user', 'position']);
	}

	public function json(){
		return json_encode($this);
	}

	public function get_message($message_id = NULL){
		if( $message_id != NULL ){

		}
		else{

		}
	}

}