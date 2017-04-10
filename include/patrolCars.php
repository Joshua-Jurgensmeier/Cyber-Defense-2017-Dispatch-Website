<?php
function getPatrolCars() {
	$query = "SELECT id, license FROM patrolCars";
	$result = $dispatch->query($query);
	$out = [];
	while ($line = $result->fetch_assoc()) {
		array_push($out, $line);
	}
	return $out;
}