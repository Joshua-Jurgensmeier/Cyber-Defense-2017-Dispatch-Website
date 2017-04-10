<?php
include 'head.php';
?>
<h2>Patrol Cars</h2>

<table border=1>
<header><th>License Plate</th><th>Officer</th><th>In Service</th><th>Action</th></header>
<?php

$query = "SELECT * FROM patrolCars";
$result = $dispatch->query($query);
while($line = $result->fetch_array()) {
	$notInService = abs($line['inService'] - 1);
	$serviceText = ($line['inService'] == 0) ? 'No' : 'Yes';
?>
	<tr>
		<td><?php echo $line['license']; ?></td>
		<td><?php echo $line['officer']; ?></td>
		<td>
			<?php if($_SESSION['dispatcher']) { ?>
				<a href="/carMarkInService.php?id=<?php echo $line['id']; ?>&new=<?php echo $notInService; ?>">
			<?php } ?>
					<?php echo $serviceText; ?>
			<?php if($_SESSION['dispatcher']) { ?>
				</a>
			<?php } ?>
		</td>
		<td>
			<?php if($_SESSION['recordsClerk']) : ?>
				<a href="/carDelete.php?id=<?php echo $line['id']; ?>">Delete</a>
			<?php endif; ?>
		</td>
	</tr>
<?php } ?>
</table>
<?php if($_SESSION['recordsClerk']) : ?>
	<a href="/carNew.php">Add new patrol car</a>
<?php
endif;

include 'foot.php';