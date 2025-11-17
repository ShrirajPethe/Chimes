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

	public function updateemail()
	{
		$con=$this->connect();
		if(!isset($_POST['username'])) {
			echo "ERROR: Could not set username";
			exit();
		}

		if(isset($_POST['email']) && $_POST['email'] != "") {

			$username = $_POST['username'];
			$email = $_POST['email'];

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "Email is invalid";
				exit();
			}

			$emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username'");
			if(mysqli_num_rows($emailCheck) > 0) {
				echo "Email is already in use";
				exit();
			}

			$updateQuery = mysqli_query($con, "UPDATE users SET email = '$email' WHERE username='$username'");
			echo "Update successful";

		}
		else {
			echo "You must provide an email";
		}
	}
}
$userdetails=new User();
$userdetails->updateemail();

?>