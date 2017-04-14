<?php
include 'head.php';

$id = $_GET['id'];

$query = $dispatchdb->prepare("DELETE FROM patrolCars WHERE id = ?");

$query->bind_param(i, $id);

$query->excecute();

$result = $query->get_result();

if($result) {
?>
	Patrol car deleted. <a href="/cars.php">Back</a>
<?php
} else {
?>
	Error deleting patrol car.
<?php
	echo $dispatchdb->error;
}

$query->free_result();

$query->close();

include 'foot.php';