<!DOCTYPE html>
<?php
$message = $_POST["wallPostMessage"];
echo $message;
?>
<html>
<head><title>SearchEventsPage</title>
	<?php include("../import/header.php");?>
</head>
<body>
	<?php echo "1st" .$message ?>
	<p><?php echo $message ?></p>
	<p> Should see post above this </p>
	<a href ="../index.php"  data-icon="home" data-ajax="false" > home </a>
	<?php echo "after" .$message ?>
</body>
</html>