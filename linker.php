<?php

//some required files
require_once 'customlib.php';

//load requester [ Guzzle ]
require_once 'vendor/autoload.php';


//load discord objects
$load = [
	'Guild', 'Message', 'Channel',
	'Utils/Embed', 'Utils/Role', 'Utils/User', 'Utils/Emoji'
];

loader($load);

//global constants
$base_api = 'https://discord.com/api/';

//loader
function loader($loads){
	foreach ($loads as $load){
		require __dir__.'/objs/'.$load.'.php';
	}
	// debug($loads);
}