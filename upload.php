<?php
move_uploaded_file($_FILES["upload"]["tmp_name"], '/var/www/dispatch/patrol/' . $_POST['fname']) or die("error uploading file");

include 'head.php';
?>

<h2>Patrol Record Upload</h2>
Your record has been added.

<?php
include 'foot.php';