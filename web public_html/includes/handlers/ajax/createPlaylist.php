<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['username'])) {

	$name = mysqli_real_escape_string($con,$_POST['name']);
	$username = mysqli_real_escape_string($con,$_POST['username']);
	$date = mysqli_real_escape_string($con,date("Y-m-d"));

	$query = mysqli_query($con, "INSERT INTO playlists VALUES(NULL, '$name', '$username', '$date')")or die('MySQL Error: '.mysqli_error($con).' ('.mysqli_errno($con).')');

}
else {
	echo "Name or username parameters not passed into file";
}

?>