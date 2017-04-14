<?php
include 'head.php';
include 'include/patrolCars.php';

if (isset($_POST['title'])) {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$assignedPatrolCar = $_POST['assignedPatrolCar'];
	$active = 0;
	if (isset($_POST['active']) && $_POST['active'] == 'on') {
		$active = 1;
	}
	$location = $_POST['location'];

	$query = $dispatchdb->prepare("INSERT INTO events(title, description, assignedPatrolCar, active, location) " .
	         "VALUES('$title', '$description', $assignedPatrolCar, $active, '$location')");



	$result = $dispatchdb->query($query);
	if (!$query) {
		echo $dispatchdb->error;
	} else { ?>
		<script type="text/javascript">window.location.href = '/events.php';</script>
	<?php
	}
}
?>
<h2>New Event</h2>

<form action="/eventNew.php" method="post">
	<label for='title'>Title:</label><br/>
	<input type='text' name='title' id='title'/><br/>
	<br/>
	<label for='description'>Description</label><br/>
	<textarea name='description' rows='4' cols='50'></textarea><br/>
	<br/>
	<label for='assignedPatrolCar'>Assign to:</label><br/>
	<select name="assignedPatrolCar" id='assignedPatrolCar'>
		<?php foreach(getPatrolCars() as &$patrolcar) { ?>
			<option value="<?php echo $patrolcar['id']; ?>"><?php echo $patrolcar['license']; ?></option>
		<?php } ?>
	</select><br/>
	<br/>
	<input type='checkbox' name='active' id='active'/><label for='active'>Active</label><br/>
	<br/>
	<label for='location'>Location</label><br/>
	<input type='text' id='location' name="location" /><br/>
	<br/>
	<input type='submit' value='Submit' />
</form>
<?php
include 'foot.php';