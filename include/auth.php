<?php
function validateCreds($username, $password) {
	$query = "SELECT * FROM users WHERE username='$username'";
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);

	$_SESSION['username'] = $data['username'];
	$_SESSION['dispatcher'] = $data['dispatcher'];
	$_SESSION['patrolOfficer'] = $data['patrolOfficer'];
	$_SESSION['recordsClerk'] = $data['recordsClerk'];

	echo "<!--" . $data['password'] . "-->";
	mysql_free_result($result);
	return $data['password'] == md5($password);
}