<?php

function get_uri()
{
	return explode('?', $_SERVER['REQUEST_URI'], $limit=2)[0];
}

$dispatcherList = array("/cars.php", "/events.php", "/carMarkInService.php", "/eventNew.php");
$officerList = array("/events.php", "/patrol.php", "/upload");
$clerkList = array("/cars.php", "/policeReport.php", "/policeReportNew.php", "/carNew.php");
$anyoneList = array("/login.php", "/logout.php", "/index.php", "/403.php", "/");

if
(
	in_array(get_uri(), $anyoneList) 

	or 
	
	(
		isset($_SESSION['authenticated']) 
			
			and 
		( 
			($_SESSION['dispatcher'] and in_array(get_uri(), $dispatcherList)) 
			or 
			($_SESSION['patrolOfficer'] and in_array(get_uri(), $officerList)) 
			or 
			($_SESSION['recordsClerk'] and in_array(get_uri(), $clerkList))
		)
	)
)

{}

else 
{
	/*
	error_log(print_r(get_uri(), TRUE));
	
	if(in_array(get_uri(), $anyoneList))
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
		error_log("auth unset");
	}
	*/

	header('Location: http://www.team12.isucdc.com/403.php');
	exit("Access denied");
}

?>
