<?php

include 'dbconf.php';
include 'passwords.php';

//Creat connection object
$dispatchdb = new mysqli($dispatch_server, $dispatch_user, $dispatch_password, $dispatch_dbname);

$query = "SELECT username FROM users";
$result = $dispatchdb->query($query);


while($line = $result->fetch_array())
{
	
	$password = $passwordList[$line['username']];

	$hash = password_hash($password);

	$query = "UPDATE users SET password=$hash WHERE username=$line['username']";

	$dispatchdb->query($query);

	echo "Set $line['username'] (password of $passwordList[$line['username']]) to $hash";

}



?>