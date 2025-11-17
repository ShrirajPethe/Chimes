<?php
//Connection

$con = mysqli_connect("localhost", "id13654019_sp", "KJF[N_%ym_t2b>K8", "id13654019_peacemusic");

if (!$con)
{
	echo(die('Could not connect: ' . mysqli_error()));
}

if(isset($_GET['id'])) {
	$genreId = $_GET['id'];
}
else {
	header("Location: index.php");
}


///////////// Getting Genres Info
$querygd = mysqli_query($con, "SELECT * FROM genres WHERE id = '$genreId' ");
//print_r($query);
//??

$genInfo = mysqli_fetch_array($querygd);
// while($playlistInfo = mysqli_fetch_row($query))

//Replace with something DESERVING AND USEFUL SYMBOLS TO WRAP PLAYLIST DATA
echo "gendata=";
echo "$genInfo[0],$genInfo[1]";
//print_r($playlistInfo); 
/*foreach($playlistInfo as $value){
	echo $value . ",";
}
*/
echo "gendataOVER";

//Genres DATA OVER


///////////// REMOVE this section Because, No artist INFO any way.
/*$query = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");
$album = mysqli_fetch_array($query);

$title = $album['title'];
$artistId = $album['artist'];
$genre = $album['genre'];
$artworkPath = $album['artworkPath'];

echo "albumdata=".$album['title'].",".$album['artist'].",".$album['genre'].",".$album['artworkPath']."albumdataOVER";*/
/////////////
$genreA = array();
/*foreach($var in $oldArray){
	$ArtistAlum[] = $var;
}
*/
if($queryS = mysqli_query($con, "SELECT * FROM songs WHERE genre='$genreId'")){
	$i = 0 ;
	while($row = mysqli_fetch_row($queryS)){
		//foreach($var in $oldArray){
		$genreA[] = $row[3];
		//}
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


//////////remember to remove ONLY THE ECHO PART NOT THE MAIN THING
/*echo "<br><br>printing ArtistAlum";
foreach($ArtistAlum as $value){
	echo $value . "<br>";
}*/

//////////remember to remove ONLY THE ECHO PART NOT THE MAIN THING
//$fruits_list = array('Orange',  'Apple', ' Banana', 'Cherry', ' Banana');
$genreUniAlbum = array_unique($genreA);
//print_r($ArtisUniAlbum);
//echo "<br><br>printing ArtisUniAlbum<br>";
/*foreach($ArtisUniAlbum as $value){
	echo $value . "<br>";
}*/
////////////////////////////

//Replace with something DESERVING AND USEFUL SYMBOLS TO WRAP ALBUM DATA
echo "GenreAlbums:";
$x = 0;
foreach ($genreUniAlbum as $albumId) {
	$qry = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");
	$artalb = mysqli_fetch_array($qry);
	$title = $artalb['title'];
	$artistId = $artalb['artist'];
	$genre = $artalb['genre'];
	$artworkPath = $artalb['artworkPath'];

	if($x == 0){
		echo $artalb['title'].",".$artalb['artist'].",".$artalb['genre'].",".$artalb['artworkPath'];
	} else{
		echo "*".$artalb['title'].",".$artalb['artist'].",".$artalb['genre'].",".$artalb['artworkPath'];
	}
	$x++;
}


mysqli_close($con);

?>