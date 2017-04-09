<?php
function getOfficers() {
	$query = "SELECT username FROM users WHERE patrolOfficer=1";
	$result = mysql_query($query);
	$out = [];
	while ($line = mysql_fetch_assoc($result)) {
		array_push($out, $line['username']);
	}
	return $out;
}