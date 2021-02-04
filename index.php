<?php 
require_once 'Discord.php';
require_once 'token.php';

$discord = new Discord($token);

$guild = $discord->get_guild(id:1111);
$channel = $guild->get_channel(id:1111);

debug($channel);