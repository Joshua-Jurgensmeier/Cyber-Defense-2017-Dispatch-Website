<?php
include 'head.php';

function getPeople() {
	global $crime_server;
	global $crime_user;
	global $crime_password;

	$crimedb = new mysqli ($crime_server, $crime_user, $crime_password)

	if($crimedb->connect_error) 
	{
		die('Error connecting to the crime db.' . $crimedb->connect_error);
	}


	$crimedb->query("USE crimedb");
	$query = 'SELECT id, name FROM people';
	$result = $crimedb->query($query);
	$out = [];
	while ($line = $result->fetch_assoc($result)) {
		array_push($out, $line);
	}
	$result->free();
	return $out;
}

function getOfficers() {
	global $crime_server;
	global $crime_user;
	global $crime_password;

	$crimedb = new mysqli ($crime_server, $crime_user, $crime_password)

	if($crimedb->connect_error) 
	{
		die('Error connecting to the crime db.' . $crimedb->connect_error);
	}

	$crimedb->query("USE crimedb");
	$query = 'SELECT id, name FROM users';
	$result = $crimedb->query($query);
	$out = [];
	while ($line = $result->fetch_assoc($result)) {
		array_push($out, $line);
	}
	$result->free();
	return $out;
}

?>
<h2>Process a Patrol Record</h2>
<form method="post" action="policeReportNew.php">
<label for="reportingOfficer">Reporting Officer:</label><br/>
<select name='reportingOfficer' id='reportingOfficer'>
	<?php
	foreach(getOfficers() as &$person) {
	?>
		<option value="<?php echo $person['id']; ?>"><?php echo $person['name']; ?></option>
	<?php
	}
	?>
</select><br />
<br />
<label for="reportTime">Report Time:</label> (yyyy-mm-dd HH:mm:ss)<br />
<input type="text" name="reportTime" id="reportTime" /><br />
<br />
<label for="offenseTime">Offense Time:</label> (yyyy-mm-dd HH:mm:ss)<br />
<input type="text" name="offenseTime" id="offenseTime" /><br />
<br />
<label for="title">Title:</label><br />
<input type='text' name='title' id='title' /><br />
<br />
<label for='description'>Description:</label><br />
<select name='description' id='description'>
	<?php
	foreach(scandir("/var/www/dispatch/patrol/") as &$dir) {
	?>
		<option value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/patrol/<?php echo $dir; ?>"><?php echo $dir; ?></option>
	<?php
	}
	?>
</select><br />
<br />
<label for="reportingPerson">Reporting Person</label><br />
<select name='reportingPerson' id='reportingPerson'>
	<?php
	foreach(getPeople() as &$person) {
	?>
		<option value="<?php echo $person['id']; ?>"><?php echo $person['name']; ?></option>
	<?php
	}
	?>
</select><br />
<br />
<input type='submit' value='Create Police Report' />
</form>

<?php
include 'foot.php';