<?php
include 'head.php';

$car = $_GET['id'];
$new = $_GET['new'];

$query = $dispatchdb->prepare("UPDATE patrolCars SET inService = ? WHERE id = ?");

$query->bind_param('ii', $new, $car);

$query->execute();

?>
Service updated.  <a href="/cars.php">Back to table</a>.
<?php

$query->close();

include 'foot.php';