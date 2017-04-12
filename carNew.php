<?php
include 'head.php';
include 'include/officers.php';

if (isset($_GET['license'])) {
	$officer = $_GET['officer'];
	$license = $_GET['license'];
	$inService = 0;
	if (isset($_GET['inService']) && $_GET['inService'] == 'on') {
		$inService = 1;
	}
	$query = "INSERT INTO patrolCars(officer, license, inService)" . 
	         "VALUES('$officer', '$license', $inService)";
	$result = $dispatchdb->query();
	if ($result) {
		exit("Patrol car added.");
	} else {
		echo "Error: " . $dispatchdb->error;
	}
}
?>

<h2>New Patrol Car</h2>
<form method="get" action="/carNew.php">
	<label for='license'>License plate:</label><br/>
	<input type='text' name='license' id='license'/><br/>
	<br/>
	<label for='officer'>Officer:</label><br/>
	<select name="officer" id='officer'>
		<?php foreach(getOfficers() as &$officer) { ?>
			<option value="<?php echo $officer; ?>"><?php echo $officer; ?></option>
		<?php } ?>
	</select><br/>
	<br/>
	<input type='checkbox' name='inService' id='inService'/><label for='inService'>In Service</label><br/>
	<br/>
	<input type="submit" value='Submit'>
</form>
<?php
include 'foot.php';