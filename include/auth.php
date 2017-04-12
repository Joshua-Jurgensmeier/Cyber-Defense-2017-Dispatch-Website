<?php
function validateCreds($username, $password) {
	global $dispatchdb;
	$query = "SELECT * FROM users WHERE username='$username'";
	$result = $dispatchdb->query($query);
	$data = $result->fetch_array();

	echo $data['username'];

	$_SESSION['username'] = $data['username'];
	$_SESSION['dispatcher'] = $data['dispatcher'];
	$_SESSION['patrolOfficer'] = $data['patrolOfficer'];
	$_SESSION['recordsClerk'] = $data['recordsClerk'];

	echo "<!-- Nice try (: -->";
	$result->free();
	return $data['password'] == md5($password);
}