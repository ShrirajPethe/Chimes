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

class User
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

	public function delPlaylist()
	{
		$con=$this->connect();
		if(!isset($_POST['username'])) {
			echo "ERROR: Could not set username";
			exit();
		}

		if(isset($_POST['playlistId'])) {
			$playlistId = $_POST['playlistId'];

			$playlistQuery = mysqli_query($con, "DELETE FROM playlists WHERE id='$playlistId'");
			$songsQuery = mysqli_query($con, "DELETE FROM playlistSongs WHERE playlistId='$playlistId'");
		}
		else {
			echo "PlaylistId was not passed into deletePlaylist.php";
		}
	}
}
$playlistDel=new User();
$playlistDel->delPlaylist();

?>