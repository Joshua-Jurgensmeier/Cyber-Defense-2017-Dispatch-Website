<?php
include 'head.php';
include 'include/patrolCars.php';

function getEvents() {

	global $dispatchdb;

	if ($_SESSION['dispatcher']) {
		$query = $dispatchdb->prepare("SELECT events.id, description, title, active, location, license FROM events LEFT JOIN patrolCars ON events.assignedPatrolCar = patrolCars.id");


	} else {
		$user = $_SESSION['username'];
		$query = $dispatchdb->prepare("SELECT events.id, description, title, active, location, license FROM events LEFT JOIN patrolCars ON events.assignedPatrolCar = patrolCars.id WHERE patrolCars.officer = ?");

		$query->bind_param('s', $user);
	}

	$query->execute();

	$result = $query->get_result();

	$out = [];
	while ($line = $result->fetch_array()) {
		array_push($out, $line);
	}

	$query->free_result();

	$query->close();

	/*Sanitize text fields
	foreach($out as $event)
	{
		$event['description'] = htmlentities($event['description'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

		$event['title'] = htmlentities($event['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

		$event['location'] = htmlentities($event['location'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
	}*/

	return $out;
}

if(isset($_GET['active'])) {
	$a = $_GET['active'];
	$id = $_GET['id'];
	$query = $dispatchdb->prepare("UPDATE events SET active=? WHERE id=?");

	$query->bind_param('ii',$a, $id);


	if (!($query->execute())) {
		echo $dispatchdb->error;
	}

	$query->close();

}

if(isset($_GET['delete'])) {
	$id = $_GET['id'];
	$query = $dispatchdb->prepare("DELETE FROM events WHERE id=?");

	$query->bind_param(i, $id);

	

	if (!($query->execute())) {
		echo $dispatchdb->error;
	}


	$query->close();
}

if(isset($_GET['assignedPatrolCar'])) {
	$assignedPatrolCar = $_GET['assignedPatrolCar'];
	$id = $_GET['id'];
	$query = $dispatchdb->prepare("UPDATE events SET assignedPatrolCar=? WHERE id=?");
	
	$query->bind_param('ii', $assignedPatrolCar, $id);

	


	if (!($query->execute())) {
		echo $dispatchdb->error;
	}

	$query->close();
}
?>
<script type="text/javascript">
	function setLicense(id, license) {
		var html = "<form method='get' action='/events.php'>";
		html += "<input type='hidden' name='id' value='" + id + "' />";
		html += "<select name='assignedPatrolCar' id='assignedPatrolCar'>";
		html += "<option value='0'>None</option>";
		<?php foreach(getPatrolCars() as &$car) {?>
			html += "<option value='<?php echo $car['id']; ?>'><?php echo $car['license']; ?></option>";
		<?php } ?>
		html += "</select>";
		html += "<input type='submit' value='Update'/>";
		html += "</form>";
		document.getElementById("license".concat(id)).innerHTML = html;
	}
</script>
<h2>Events</h2>
<table border="1">
	<tr><th>Title</th><th>Description</th><th>Assigned Patrol Car</th><th>Active</th><th>Location</th><th>Action</th></tr>
	<?php
	foreach(getEvents() as &$event) {
	?>
		<tr>
			<td><?php echo htmlentities($event['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
			<td><?php echo htmlentities($event['description'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
			<td id="license<?php echo $event['id']; ?>">
				<a href="javascript:setLicense(<?php echo $event['id']; ?>, '<?php echo $event['license']; ?>');">
					<?php if ($event['license'] == "") { ?>
						None
					<?php } else { 
						echo $event['license'];
					} ?>
				</a>
			</td>
			<td>
				<?php if($event['active'] == 0) { ?>
					<a href='/events.php?id=<?php echo $event['id']; ?>&active=1'>No</a>
				<?php } else { ?>
					<a href='/events.php?id=<?php echo $event['id']; ?>&active=0'>Yes</a>
				<?php } ?>
			</td>
			<td><?php echo htmlentities($event['location'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></td>
			<td>
				<?php if($_SESSION['dispatcher']) { ?>
					<a href="/events.php?delete=true&id=<?php echo $event['id']; ?>">Delete</a>
				<?php } ?>
			</td>
		</tr>
	<?php
	}
	?>
</table>
<?php if($_SESSION['dispatcher']) { ?>
	<a href="/eventNew.php">New Event</a>
<?php } ?>

<?php
include 'foot.php';