<?php 
require_once 'Discord.php';
require_once 'token.php';

$discord = new Discord($token);

$guild = $discord->get_guild(id:794796356844781599);
$channel = $guild->get_channel(id:795222945726464031);

debug($channel);