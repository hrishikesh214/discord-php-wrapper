<?php 

require_once 'linker.php';

class Emoji{
	public $id;
	public $name;
	public $roles;
	public $user;
	public $require_colons;
	public $managed;
	public $animated;
	public $available;

	public function __construct($obj){
		set_properties($this, $obj, ['id', 'name', 'require_colons', 'managed', 'animated', 'available']);
		$this->roles = get_object($obj, 'roles', 'Role');
		$this->user = get_object($obj, 'user', 'User');
	}

	public function json(){
		return json_encode($this);
	}
}