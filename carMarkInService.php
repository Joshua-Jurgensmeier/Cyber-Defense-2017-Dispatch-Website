<?php
include 'head.php';

$car = $_GET['id'];
$new = $_GET['new'];

$query = "UPDATE patrolCars SET inService = $new WHERE id = $car";
$result = mysql_query($query);
?>
Service updated.  <a href="/cars.php">Back to table</a>.
<?php
include 'foot.php';