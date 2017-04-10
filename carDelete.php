<?php
include 'head.php';

$id = $_GET['id'];
$query = "DELETE FROM patrolCars WHERE id = $id";
$result = $connection->query($query);
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
include 'foot.php';