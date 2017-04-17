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

	$hash = password_hash($password, PASSWORD_DEFAULT);
	$user = $line['username'];

	$query = "UPDATE users SET password=$hash WHERE username=$user";

	$dispatchdb->query($query);

	echo "Set $user (password of $passwordList[$user]) to $hash";

}



?>