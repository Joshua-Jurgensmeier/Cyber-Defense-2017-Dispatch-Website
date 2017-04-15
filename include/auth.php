<?php
function validateCreds($username, $password) {
	global $dispatchdb;

	$query = $dispatchdb->prepare("SELECT * FROM users WHERE username=?");

	$query->bind_param('s', $username);

	$query->execute();

	$result = $query->get_result();
	
	$data = $result->fetch_array();

	$_SESSION['username'] = $data['username'];
	$_SESSION['dispatcher'] = $data['dispatcher'];
	$_SESSION['patrolOfficer'] = $data['patrolOfficer'];
	$_SESSION['recordsClerk'] = $data['recordsClerk'];

	echo "<!-- correcthorsebatterystaple -->";
	
	$query->free_result();
	$query->close();

	return $data['password'] == md5($password);
}
