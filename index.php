<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Discord.php';
require_once 'token.php';

$discord = new Discord($token);

$guild = $discord->get_guild(id:794796356844781599);

debug($guild->get_channel(id:795166923213635584));

// gid = 794796356844781599
// cid = 795166923213635584
//name = talk