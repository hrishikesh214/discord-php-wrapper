<?php

require_once 'linker.php';

class Role{
	public $id;
	public $name;
	public $color;
	public $hoist;
	public $position;
	public $permissions;
	public $managed;
	public $mentionable;
	public $tags;

	public function __construct($obj){
		set_properties($this, $obj, ['id', 'name', 'color', 'hoist', 'position', 'permissions', 'managed', 'mentionable']);
		$this->tags = get_object($obj, 'tags', 'RoleTags');
	}

}



class RoleTags{
	public $bot_id;
	public $integration_id;
	public $premium_subscriber;

	public function __construct($obj){
		set_properties($this, $obj, ['bot_id', 'premium_subscriber', 'integration_id']);
	}
}