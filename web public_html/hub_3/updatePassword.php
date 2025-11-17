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

	public function updatepass()
	{
		$con=$this->connect();
		if(!isset($_POST['username'])) {
			echo "ERROR: Could not set username";
			exit();
		}

		if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])) {
			echo "Not all passwords have been set";
			exit();
		}

		if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == ""  || $_POST['newPassword2'] == "") {
			echo "Please fill in all fields";
			exit();
		}

		$username = $_POST['username'];
		$oldPassword = $_POST['oldPassword'];
		$newPassword1 = $_POST['newPassword1'];
		$newPassword2 = $_POST['newPassword2'];

		$oldMd5 = md5($oldPassword);

		$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$oldMd5'");
		if(mysqli_num_rows($passwordCheck) != 1) {
			echo "Previous Password is incorrect";
			exit();
		}

		if($newPassword1 != $newPassword2) {
			echo "Your new passwords do not match";
			exit();
		}

		if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
			echo "Your password must only contain letters and/or numbers";
			exit();
		}

		if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
			echo "Your username must be between 5 and 30 characters";
			exit();
		}

		$newMd5 = md5($newPassword1);

		$query = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");
		echo "Update successful";
	}
}
$userdetails=new User();
$userdetails->updatepass();

?>