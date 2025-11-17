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

	public function createPlaylist()
	{
		$con=$this->connect();
		if(!isset($_POST['username'])) {
			echo "ERROR: Could not set username";
			exit();
		}

		if(isset($_POST['name']) && isset($_POST['username'])) {
			$name = mysqli_real_escape_string($con,$_POST['name']);
			$username = mysqli_real_escape_string($con,$_POST['username']);
			$date = mysqli_real_escape_string($con,date("Y-m-d"));

			$query = mysqli_query($con, "INSERT INTO playlists VALUES(NULL, '$name', '$username', '$date')")or die('MySQL Error: '.mysqli_error($con).' ('.mysqli_errno($con).')');

		}
		else {
			echo "Name or username parameters not passed into file";
		}

	}
}
$playlistCreation=new User();
$playlistCreation->createPlaylist();

?>