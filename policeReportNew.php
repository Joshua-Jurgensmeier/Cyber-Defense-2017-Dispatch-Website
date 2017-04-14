<?php
include 'head.php';

$reportingOfficer = $_POST['reportingOfficer'];
$reportTime = $_POST['reportTime'];
$offenseTime = $_POST['offenseTime'];
$title = $_POST['title'];
$description = $_POST['description'];
$reportingPerson = $_POST['reportingPerson'];

$crimedb = new mysqli ($crime_server, $crime_user, $crime_password);

if($crimedb->connect_error) 
{
	die('Error connecting to the crime db.' . $crimedb->connect_error);
}

$crimedb->query("USE crimedb");

$query = $crimedb->prepare('INSERT INTO police_report(reporting_officer, report_time, offense_time, title, description, reporting_person) ' .
         "VALUES(?, ?, ?, ?, ?, ?)");

$query->bind_param('issssi', $reportingOfficer, $reportTime, $offenseTime, $title, $description, $reportingPerson);


if ($query->execute()) {
?>
	Report saved on the Crime DB.
<?php } else { ?>
	Problem saving the report: <?php echo 	$crimedb->error;
} 

$query->close();

?>

<?php
include 'foot.php';