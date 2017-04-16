<?php

function fix($inputStr)
{
	return explode('?', $inputStr, $limit=2)[0];
}

$dispatcherList = array("/cars.php", "/events.php", "/carMarkInService.php", "/eventNew.php");
$officerList = array("/events.php", "/patrol/", "/patrol.php", "/upload");
$clerkList = array("/cars.php", "/patrol/", "/policeReport.php", "/policeReportNew.php", "/carNew.php");
$anyoneList = array("/login.php", "/logout.php", "/index.php", "/403.php", "/");

if
(
	in_array($_SERVER['REQUEST_URI'], $anyoneList) 

	or 
	
	(
		isset($_SESSION['authenticated']) 
			
			and 
		( 
			($_SESSION['dispatcher'] and in_array(fix($_SERVER['REQUEST_URI']), $dispatcherList)) 
			or 
			($_SESSION['patrolOfficer'] and in_array(fix($_SERVER['REQUEST_URI']), $officerList)) 
			or 
			($_SESSION['recordsClerk'] and in_array(fix($_SERVER['REQUEST_URI']), $clerkList))
		)
	)
)

{}

else 
{
	error_log(print_r(fix($_SERVER['REQUEST_URI']), TRUE));
	
	if(in_array($_SERVER['REQUEST_URI'], $anyoneList))
	{
		error_log("uri in anyoneList");
	}
	else
	{
		error_log("uri not in anyoneList");	
	}

	if(isset($_SESSION['authenticated']))
	{
		error_log("auth set");
	}
	else
	{
		error_log("auth unset")
	}

	header('Location: http://www.team12.isucdc.com/403.php');
	exit("Access denied");
}

?>
