<?php
//Connection

$con = mysqli_connect("localhost", "id13654019_sp", "KJF[N_%ym_t2b>K8", "id13654019_peacemusic");

if (!$con)
{
	echo(die('Could not connect: ' . mysqli_error()));
}

if(isset($_GET['id'])) {
	$givenID = $_GET['id'];
}
else {
	header("Location: index.php");
}


///////////// Getting Album Info
$query = mysqli_query($con, "SELECT * FROM playlists WHERE id = '$givenID' ");
//print_r($query);
//??

$playlistInfo = mysqli_fetch_array($query);
// while($playlistInfo = mysqli_fetch_row($query))

//Replace with something DESERVING AND USEFUL SYMBOLS TO WRAP PLAYLIST DATA
echo "playlistdata=";
echo "$playlistInfo[0],$playlistInfo[1],$playlistInfo[2],$playlistInfo[3]";
//print_r($playlistInfo); 
/*foreach($playlistInfo as $value){
	echo $value . ",";
}
*/
echo "playlistdataOVER";

//PLAYLIST DATA OVER


$SongsinPla = array();

//REMOVE THE NEXT LINE / REPPLACE IT
echo "<br>All Info Of Song For Each Playlist song Begins::  ";
//MAIN query
//		   					     SELECT * FROM `playlistSongs` WHERE `playlistId` = 7 ORDER BY `playlistOrder` ASC
$i = 0 ;
if($query2 = mysqli_query($con, "SELECT * FROM playlistSongs WHERE playlistId = '$givenID' ORDER BY playlistOrder ASC ")){
	// $i = 0 ;
	while($row = mysqli_fetch_row($query2)){
		/*echo "<br>st_1::<br>";
		print_r($row);*/
		$SongsinPla[] = $row[1];
		//////////////////////
	}
	foreach ($SongsinPla as $songId) {
			# code...
		if($queryS = mysqli_query($con, "SELECT * FROM songs WHERE id='$songId'")){

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
	}
/////////////////////
		/*if($i == 0){
			echo "$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]";
		} else{
			echo "*$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]";
		}*/
		// $i++;


		mysqli_free_result($query2);
    // echo "Records inserted successfully.";
	} else{
		echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
		if (!mysqli_query($con, $query2)) {
			printf("Error message: %s", mysqli_error($con));
		}
	}

//REMOVE THESE
	echo "All Info Of Song For Each Playlist song Ends::  ";

/////////////
////////////////////////////
	mysqli_close($con);

	?>