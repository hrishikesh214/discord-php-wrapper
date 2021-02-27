<?php

function debug($var){
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

function get_property($obj, $property){
	if (property_exists($obj, $property) && $obj->$property != NULL){
		return $obj->$property;
	}
	else return NULL;
}

function get_object($obj, $property, $o){
    $o = 'Discord\Utils\\'.$o;
	if(property_exists($obj, $property) && $obj->$property != NULL){
		if(is_array($obj->$property)){
			foreach($obj->$property as $props){
				$stack[] = new $o($props);
			}
			return $stack;
		}
		else return new $o($obj->$property);
	}
	else return NULL;
}

function set_properties($to, $from, $properties){
	foreach($properties as $property){
		if (property_exists($from, $property) && $from->$property != NULL){
			$to->$property = $from->$property;
		}
	}
}