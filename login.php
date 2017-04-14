<?php
include 'head.php';
include 'include/auth.php';

$errorMessage = "";

if ($_GET['username'] && validateCreds($_GET['username'], $_GET['password'])) {
	$_SESSION['authenticated'] = True;
	echo "authenticated";
?>
	<script type="text/javascript">document.location.href="/"</script>
<?php
} elseif (isset($_GET['username'])) {
	$errorMessage = "Incorrect username or password.";
}
?>

<h2>Log In</h2>
<hr/>
<div class="error"><?php echo $errorMessage ?></div>
<form method="get" action="/login.php">
<label for="username">Username:</label><br/>
<input type="text" name="username" id="username" /><br/>
<br/>
<label for="password">Password:</label><br/>
<input type="password" name="password" id="password" /><br/>
<br/>
<input type="Submit" value="Log In" />
</form>

<?php
include 'foot.php';
