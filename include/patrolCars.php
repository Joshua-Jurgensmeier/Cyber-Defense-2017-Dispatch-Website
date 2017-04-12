<?php
function getPatrolCars() {
	global $dispatchdb;
	$query = "SELECT id, license FROM patrolCars";
	$result = $dispatchdb->query($query);
	$out = [];
	while ($line = $result->fetch_assoc()) {
		array_push($out, $line);
	}
	return $out;
}