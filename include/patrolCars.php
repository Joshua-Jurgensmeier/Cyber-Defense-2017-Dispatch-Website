<?php
function getPatrolCars() {
	$query = "SELECT id, license FROM patrolCars";
	$result = mysql_query($query);
	$out = [];
	while ($line = mysql_fetch_assoc($result)) {
		array_push($out, $line);
	}
	return $out;
}