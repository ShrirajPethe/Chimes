<?php
include("../../config.php");


if(isset($_POST['playlistId']) && isset($_POST['songId'])) {

	$playlistId = mysqli_real_escape_string($con,$_POST['playlistId']);
	$songId =  mysqli_real_escape_string($con,$_POST['songId']);

	$orderIdQuery = mysqli_query($con, "SELECT MAX(playlistOrder) + 1 as playlistOrder FROM playlistSongs WHERE playlistId='$playlistId'");
	$row =  mysqli_fetch_array($orderIdQuery);

	$order = $row['playlistOrder'];

	if (empty($order)) {
		$order = 0;
	  // echo "Variable 'order' is empty.<br>" . $order;
	}

	$query = mysqli_query($con, "INSERT INTO playlistSongs VALUES(NULL, '$songId', '$playlistId', '$order')")or die( $songId . $playlistId . $order . 'MySQL Error: '.mysqli_error($con).' ('.mysqli_errno($con).')' );


}
else {
	echo "PlaylistId or songId was not passed into addToPlaylist.php";
}



?>