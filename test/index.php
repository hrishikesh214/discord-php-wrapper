<?php 
require_once __dir__.'\..\autoload.php';
require_once 'token.php';
//require 'vendor/autoload.php';


$discord = new Discord\Client($token);
echo "<pre>";
$guild = $discord->get_guild(id:746337818388987967);
$channel = $guild->get_channel(id:764393920381190144);
//$msg = $channel->send("Check");
//$msg->delete();
$msg = $channel->get_message(id:815126152795521024);
debug($msg);