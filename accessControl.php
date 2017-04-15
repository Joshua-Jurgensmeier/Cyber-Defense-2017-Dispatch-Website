<?php

$dispatcherList = ["/cars.php", "/events.php", "/carMarkInService.php", "/eventNew.php"];
$officerList = ["/events.php", "/patrol/", "/patrol.php", "/upload"];
$clerkList = ["/cars.php", "/patrol/", "/policeReport.php", "/policeReportNew.php", "/carNew.php"];
$anyoneList = ["/login.php", "/logout.php", "/index.php", "/403.php"];

if(!(($_SESSION['dispatcher'] and $in_array($_SERVER['REQUEST_URI'], $dispatcherList)) or 
	($_SESSION['patrolOfficer'] and $in_array($_SERVER['REQUEST_URI'], $officerList)) or 
	($_SESSION['recordsClerk'] and $in_array($_SERVER['REQUEST_URI'], $clerkList)) or
	($in_array($_SERVER['REQUEST_URI'], $anyoneList))))
{
	header('Location: http://www.team12.isucdc.com/403.php');
	exit("Access denied");
}

?>