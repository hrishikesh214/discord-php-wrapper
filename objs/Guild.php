<?php 

require_once 'linker.php';

class Guild extends Discord{
	public $id;
	public $name;
	public $icon;
	public $icon_hash;
	public $splash;
	public $discovery_splash;
	public $owner;
	public $owner_id;
	public $permissions;
	public $region;
	public $afk_channel_id;
	public $afk_timeout;
	public $widget_enabled;
	public $widget_channel_id;
	public $verification_level;
	public $roles;
	public $emojis;
	public $joined_at;
	public $large;
	public $member_count;
	public $members;
	public $channels;
	public $description;
	public $banner;

	public function __construct($obj){
		set_properties($this, $obj, ['id', 'name', 'icon', 'icon_hash', 'splash', 'discovery_splay', 'owner_id', 'permissions', 'region', 'afk_channel_id', 'widget_enabled', 'widget_channel_id', 'verification_level', 'joined_at', 'large', 'member_count', 'description', 'banner']);
		$this->roles = get_object($obj, 'roles', 'Role');
		$this->emojis = get_object($obj, 'emojis', 'Emoji');
		if(get_property($obj, 'channels')){
			foreach(get_property($obj, 'channels') as $channel){
				$this->channels[] = new Channel($channel);
			}
		}
		global $base_api, $default_headers;
		$this->guzzle = new GuzzleHttp\Client([
			'base_uri' => $base_api
		]);
		$this->headers = array(
			'Accept'=> 'application/json',
			'Authorization' => 'Bot '.$this->token
		);

	}

	public function json(){
		return json_encode($this);
	}

	public function get_channel($id = NULL, $name = NULL){
		debug($this->headers);
			die();
		if($id != NULL){
			$link = 'channels/'.$id;
			$res = $this->guzzle->request('GET', $link, ['headers' => $this->headers]);
			$channel = new Channel(json_decode($res->getBody()));
			return $channel;
		}
		else if($name != NULL){
			$link = 'guilds/'.$this->id.'/channels';

			$res = $this->guzzle->request('GET', $link, ['headers' => $this->headers]);
			$res = json_decode($res->getBody());
			$required = NULL;
			foreach ($res as $r) {
				if($r->name == $name && $r->type == 0){
					$required = $r;
					break;
				}
			}
			$channel = new Channel($required);
			return $channel;
		}
		else{
			return NULL;
		}
	}

}