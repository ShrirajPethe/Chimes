<?php
//Connection

$con = mysqli_connect("localhost", "id13654019_sp", "KJF[N_%ym_t2b>K8", "id13654019_peacemusic");

if (!$con)
{
	echo(die('Could not connect: ' . mysqli_error()));
}

if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}


///////////// Getting Album Info
$query = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");
$album = mysqli_fetch_array($query);

$title = $album['title'];
$artistId = $album['artist'];
$genre = $album['genre'];
$artworkPath = $album['artworkPath'];

echo "albumdata=".$album['title'].",".$album['artist'].",".$album['genre'].",".$album['artworkPath']."albumdataOVER";
/////////////

if($queryS = mysqli_query($con, "SELECT * FROM songs WHERE album='$albumId' ORDER BY albumOrder ASC")){
	$i = 0 ;
	while($row = mysqli_fetch_row($queryS)){
		if($i == 0){
			echo "$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]";
		} else{
			echo "*$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]";
		}
		$i++;
	}

	mysqli_free_result($queryS);
    // echo "Records inserted successfully.";
} else{
	echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
	if (!mysqli_query($con, $queryS)) {
		printf("Error message: %s", mysqli_error($con));
	}
}

////////////////////////////
	mysqli_close($con);

?>