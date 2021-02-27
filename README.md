# Discord-PHP-Wrapper
## `Create Dashboard Easily`

# `Installation`
```apacheconf
composer require hrishikesh214/discord-php-wrapper
```
Now include `vendor/autoload.php` to your file !

## `Creating discord object`

```php 
$discord = new Discord\Client("Bot token here"); 
```
    
## `How to get Guild?`
Getting guild is easy!

```php
$guild = $discord->get_guild(id:your_guild_id);
```

## `Getting channels`
### With Channel ID
```php
$channel = $guild->get_channel(id:channel_id_here);
```
### With Name
```php
$channel = $guild->get_channel(name:"channel name here");
```
You have to provide **exact name** of the channel!
### Getting All Channels

```php
$channel = $guild->get_channel();
```
   Gives all channels in a guild if **no parameter** is passed

## `Getting Messages`
```php
$channel = $guild->get_channel(id:message_id_here);
```

If **no parameter** is passed, then gives **multiple messages**

## `Sending  a Message`

To do this you have to use Message class
```php
$new_message = $channel->send("message here");
```

This will send simple message

### Sending Embeds
```php
    $embed = new Embed(data:[
    	'title' => 'Embed title here',
    	'desc' => 'Description of embed here',
    	'fields' => [
    		[
    			'name' => 'field1',
    			'value' => 'value1',
    			'inline' => true
    		],
    		[
    			'name' => 'field2',
    			'value' => 'value2',
    			'inline' => false
    		]
    	]
    ]);
    
    $new_message = $channel->send(embed:$embed);
```
We created Embed object first and then send with `$channel->send(embed:$embed)`.
You can refer to Discord Developer Documention for elements of embed and pass in data parameter in **form of array**!

## `Editing Message`

Easily Edit any message sent by bot!
```php
    //Fetch Message from channel
    $message = $channel->get_message(id:message_id);
	
	//Edit simple messages
    $edited_msg = $message->edit(content:"new content");

	//Edit Embed = pass new embed object with new content
    $edited_msg = $message->edit(embed:$edited_embed);
```
## Deleting Message
```php
    //Fetch Message from channel
    $message = $channel->get_message(id:message_id);

	//Call delete() member of message
	$message->delete();
```

### Made with ❤️By [Hrishikesh](https://github.com/hrishikesh214)
