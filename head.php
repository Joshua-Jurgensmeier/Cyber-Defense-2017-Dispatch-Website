<?php
include 'dbconf.php'

session_start();
$db2Connection = 'crime.team12.isucdc.com';
/*
$db = mysql_connect('', 'root', '') or die("Error connecting to MySQL.");
mysql_select_db('dispatch') or die("Error selecting dispatch database.");
*/

//Creat connection object
$dispatchdb = new mysqli($dispatch_server, $dispatch_user, $dispatch_password);

if($dispatchdb->connect_error) 
{
	die("Failed to connect: " . $dispatchdb->connect_error);
}
?>

<html>
<head>
<title>Iowa State Police - Dispatch System</title>
<style>
	body {
		background-color: tan;
		font-family: sans-serif;
	}
	h1 {
		font-size: 4em;
		text-align: center;
	}
	.bodyDiv {
		margin-left: auto;
		margin-right: auto;
		width: 800px;
	}
	.menu {
		border-bottom: 1px solid gray;
		text-align: center;
	}
	.error {
		color: red;
		font-family: "Brush Script MT", cursive;
		font-size: 1.6em;
	}
</style>
</head>
<body>
<div class="bodyDiv">
	<h1>Police Dispatch</h1>
	<div class="menu">
		<?php if($_SESSION['authenticated']) : ?>
			<a href="/logout.php">Log out</a>
		<?php else : ?>
			<a href="/login.php">Log in</a>
		<?php endif; ?>
		<?php if($_SESSION['dispatcher'] || $_SESSION['recordsClerk']) : ?>
			| <a href="/cars.php">Patrol cars</a>
		<?php endif; if($_SESSION['dispatcher'] || $_SESSION['patrolOfficer']) : ?>
			| <a href="/events.php">Events</a>
		<?php endif; if($_SESSION['patrolOfficer'] || $_SESSION['recordsClerk']) : ?>
			| <a href="/patrol/">Patrol records</a>
			<?php if($_SESSION['patrolOfficer']) : ?>
				(<a href="/patrol.php">new</a>)
			<?php endif; if($_SESSION['recordsClerk']) : ?>
				(<a href="/policeReport.php">process</a>)
			<?php endif; ?>
		<?php endif; ?>
	</div>
