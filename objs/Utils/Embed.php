<?php

require_once __dir__.'/../../linker.php';

class Embed{
	public $title;
	public $type;
	public $description;
	public $url;
	public $timestamp;
	public $color;
	public $footer;
	public $image;
	public $thumbnail;
	public $video;
	public $provider;
	public $author;
	public $fields;

	public function __construct($obj = NULL, $data = NULL){
		if($obj != NULL){
			$this->set($obj);
		}
		else if($data != NULL){
			$this->set(json_decode(json_encode($data)));
		}
		else{
			$this->set(new stdClass());
		}
	}

	private function set($obj){
		set_properties($this, $obj, ['title', 'type', 'description', 'url', 'timestamp', 'color']);
		$this->footer = get_object($obj, 'footer', 'EmbedFooter');
		$this->image = get_object($obj, 'image', 'EmbedImage');
		$this->thumbnail = get_object($obj, 'thumbnail', 'EmbedThumbnail');
		$this->video = get_object($obj, 'video', 'EmbedVideo');
		$this->provider = get_object($obj, 'provider', 'EmbedProvider');
		$this->author = get_object($obj, 'author', 'EmbedAuthor');
		$this->fields = get_object($obj, 'fields', 'EmbedField');
	}

	public function json(){
		return json_encode($this);
	}

}

class EmbedField{
	public $name;
	public $value;
	public $inline;

	public function __construct($obj){
		set_properties($this, $obj, ['name', 'value', 'inline']);
	}

}

class EmbedFooter{
	public $text;
	public $icon_url;
	public $proxy_icon_url;

	public function __construct($obj){
		set_properties($this, $obj, ['text', 'icon_url', 'proxy_icon_url']);
	}

}

class EmbedAuthor{
	public $name;
	public $url;
	public $icon_url;
	public $proxy_icon_url;

	public function __construct($obj){
		set_properties($this, $obj, ['name', 'url', 'icon_url', 'proxy_icon_url']);
	}

}

class EmbedProvider{
	public $name;
	public $url;

	public function __construct($obj){
		set_properties($this, $obj, ['name', 'url']);
	}

}

class EmbedImage{
	public $height;
	public $width;
	public $url;
	public $proxy_url;

	public function __construct($obj){
		set_properties($this, $obj, ['height', 'width', 'url', 'proxy_url']);
	}

}

class EmbedVideo{
	public $height;
	public $width;
	public $url;
	public $proxy_url;

	public function __construct($obj){
		set_properties($this, $obj, ['height', 'width', 'url', 'proxy_url']);
	}

}

class EmbedThumbnail{
	public $height;
	public $width;
	public $url;
	public $proxy_url;

	public function __construct($obj){
		set_properties($this, $obj, ['height', 'width', 'url', 'proxy_url']);
	}

}