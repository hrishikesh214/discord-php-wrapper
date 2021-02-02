<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Discord.php';

$discord = new Discord("NzkxNjQyMjg0MDU1NzI0MDM0.X-SIVA.CODGUMe9MMshgmFtwXrcF5l969M");

$guild = $discord->get_guild(id:794796356844781599);

debug($guild->get_channel(id:795166923213635584));

// gid = 794796356844781599
// cid = 795166923213635584
//name = talk