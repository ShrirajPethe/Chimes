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

	public function getemail()
	{
		if(isset($_POST['username']) )
		{
			$con=$this->connect();

			$username = mysqli_real_escape_string($con,$_POST['username']);

			$query = mysqli_query($con, "SELECT email FROM users WHERE username='".$username."'");
			$row = mysqli_fetch_array($query);
			echo $row['email'];
			// return $row['email'];
		}
	}
}
$userdetails=new User();
$userdetails->getemail();

?>