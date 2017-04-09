<?php
include 'head.php';
?>
<h2>Patrol Record Upload</h2>

<form method="POST" action="upload.php" enctype="multipart/form-data">
<label for="upload">File:</label><br/>
<input type="file" name="upload" id="upload" /><br />
<br />
<label for="fname">File name:</label><br />
<input type="text" name="fname" id="fname" /><br />
<input type="submit" value="Upload" />
</form>

<?php
include 'foot.php';