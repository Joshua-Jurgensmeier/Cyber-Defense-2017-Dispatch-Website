
<?php
function getOfficers() {
	$query = "SELECT username FROM users WHERE patrolOfficer=1";
	$result = $dispatchdb->query($query);
	$out = [];
	while ($line = $result->fetch_assoc()) {
		array_push($out, $line['username']);
	}
	return $out;
}