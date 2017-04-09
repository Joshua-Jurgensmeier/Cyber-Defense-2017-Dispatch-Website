<?php
include 'head.php';

$reportingOfficer = $_POST['reportingOfficer'];
$reportTime = $_POST['reportTime'];
$offenseTime = $_POST['offenseTime'];
$title = $_POST['title'];
$description = $_POST['description'];
$reportingPerson = $_POST['reportingPerson'];

$db2 = mysql_connect($db2Connection, 'remote', 'cdc') or die('Error connecting to the crime db.');
mysql_query("USE crimedb");
$query = 'INSERT INTO police_report(reporting_officer, report_time, offense_time, title, description, reporting_person) ' .
         "VALUES($reportingOfficer, '$reportTime', '$offenseTime', '$title', '$description', $reportingPerson)";
$result = mysql_query($query, $db2);
if ($result == true) {
?>
	Report saved on the Crime DB.
<?php } else { ?>
	Problem saving the report: <?php echo mysql_error($db2);
} ?>

<?php
include 'foot.php';