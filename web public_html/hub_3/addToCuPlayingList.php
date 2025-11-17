<?php

class Constants
{
    //DATABASE DETAILS
	static $DB_SERVER="localhost";
	static $DB_NAME="id13654019_peacemusic";
	static $USERNAME="id13654019_sp";
	static $PASSWORD="KJF[N_%ym_t2b>K8";

    //STATEMENTS
//  $albumId = $_GET['id'];

//    static $SQL_SELECT_ALL="SELECT * FROM songs WHERE album='".$albumId."' ORDER BY albumOrder ASC";
//    static $SQL_SELECT_ALL="SELECT * FROM albums";

}

class addToCuPlaying
{
	public function connect()
	{
		$con=new mysqli(Constants::$DB_SERVER,Constants::$USERNAME,Constants::$PASSWORD,Constants::$DB_NAME);
		if($con->connect_error)
		{
            //TODO: Add printing of errors
			return null;
		}else
		{
			return $con;
		}
	}


	public function send()
	{
		if(isset($_POST['songId']) && isset($_POST['owner'])) {

			$con=$this->connect();

			$songId =  mysqli_real_escape_string($con,$_POST['songId']);
			$owner = mysqli_real_escape_string($con,$_POST['owner']);

			$orderIdQuery = mysqli_query($con, "SELECT MAX(playlistOrder) + 1 as playlistOrder FROM currentPlayingList WHERE owner='$owner'");
			$row =  mysqli_fetch_array($orderIdQuery);

			$order = $row['playlistOrder'];

			if (empty($order)) {
				$order = 0;
	  		// echo "Variable 'order' is empty.<br>" . $order;
			}

			$query = mysqli_query($con, "INSERT INTO currentPlayingList VALUES(NULL, '$songId', '$owner', '$order')")or die( $songId . $owner . $order . 'MySQL Error: '.mysqli_error($con).' ('.mysqli_errno($con).')' );

			// $result=$con->query($query);
		}
		else {
			echo "owner or songId was not passed into addToPlaylist.php";
		}
	}
}


/*
if(isset($_GET['id'])) {
    $plyID = $_GET['id'];
}
else {
    header("Location: index.php");
}
*/

$add2CuPlLi=new addToCuPlaying();
$add2CuPlLi->send();
//$add2CuPlLi->select();
?>