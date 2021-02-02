<?php

require_once 'linker.php';

class User{
	public $id;
	public $username;
	public $discriminator;
	public $avatar;
	public $bot;
	public $system;
	public $mfa_enabled;
	public $locale;
	public $verified;
	public $email;
	public $flags;
	public $premium_type;
	public $public_flags;

	public function __construct($obj){
		set_properties($this, $obj, ['id', 'username', 'discriminator', 'avatar', 'bot', 'system', 'mfa_enabled', 'locale', 'verified', 'email', 'flags', 'premium_type', 'public_flags']);
	}

	public function json(){
		return json_encode($this);
	}

}