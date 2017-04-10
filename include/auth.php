<?php
function validateCreds($username, $password) {
	$query = "SELECT * FROM users WHERE username='$username'";
	$result = $dispatch->query($query);
	$data = $result->fetch_array();

	$_SESSION['username'] = $data['username'];
	$_SESSION['dispatcher'] = $data['dispatcher'];
	$_SESSION['patrolOfficer'] = $data['patrolOfficer'];
	$_SESSION['recordsClerk'] = $data['recordsClerk'];

	echo "<!-- Nice try (: -->";
	$result->free();
	return $data['password'] == md5($password);
}