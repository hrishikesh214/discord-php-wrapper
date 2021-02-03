<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Discord.php';
require_once 'token.php';

$discord = new Discord($token);
echo 
"<pre>";
$guild = $discord->get_guild(id:794796356844781599);
$channel = $guild->get_channel(id:795222945726464031);

// debug($guild);

$embed = new Embed(data:[
		'title' => 'check',
		'description' => 'lessg'
	]);
// debug($embed);
// die();
// $m2 = $channel->send(embed:$embed);
$m = $channel->get_message(id:806527376983851048);
$m->delete();
// debug($m);

// gid = 794796356844781599
// cid = 795222945726464031
//name = talk
// mid = 806511292415213619