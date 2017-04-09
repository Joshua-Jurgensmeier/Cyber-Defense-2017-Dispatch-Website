<?php
include 'head.php';

$id = $_GET['id'];
$query = "DELETE FROM patrolCars WHERE id = $id";
$result = mysql_query($query);
if($result) {
?>
	Patrol car deleted. <a href="/cars.php">Back</a>
<?php
} else {
?>
	Error deleting patrol car.
<?php
	echo mysql_error();
}
include 'foot.php';