<?php 

require_once __dir__.'/../linker.php';

class Guild{
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
	protected $token;
	private $guzzle;
	private $headers;

	public function __construct($obj){
		global $token;
		$this->token = $token;
		set_properties($this, $obj, ['id', 'name', 'icon', 'icon_hash', 'splash', 'discovery_splay', 'owner_id', 'permissions', 'region', 'afk_channel_id', 'widget_enabled', 'widget_channel_id', 'verification_level', 'joined_at', 'large', 'member_count', 'description', 'banner']);
		$this->roles = get_object($obj, 'roles', 'Role');
		$this->emojis = get_object($obj, 'emojis', 'Emoji');
		$this->channels = get_object($obj, 'channels', 'Channel');
		global $base_api;
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
			$link = 'guilds/'.$this->id.'/channels';
			// debug($this->headers);
			// die();
			$res = $this->guzzle->request('GET', $link, ['headers' => $this->headers]);
			$res = json_decode($res->getBody());
			foreach($res as $c){
				$channels[] = new Channel($c);
			}
			return $channels;
		}
	}

}