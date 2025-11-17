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

class addPlays
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
		if(isset($_POST['songId'])) {

			$con=$this->connect();

			$songId =  mysqli_real_escape_string($con,$_POST['songId']);
												//SELECT MAX(plays)+1 AS `plays` FROM `songs` WHERE `id` = 24 
			$playNosQuery = mysqli_query($con, "SELECT MAX(plays)+1 AS plays FROM songs WHERE id = '".$songId."'");
			$row =  mysqli_fetch_array($playNosQuery);

			$plays = $row['plays'];

			if (empty($plays)) {
				$plays = 1;
			}
								// UPDATE Customers SET ContactName = 'Alfred Schmidt', City= 'Frankfurt' WHERE CustomerID = 1; 
			$query = mysqli_query($con, "UPDATE songs SET plays = '".$plays."' WHERE id = '".$songId."' ")or die( 'MySQL Error: '.mysqli_error($con).' ('.mysqli_errno($con).')' );
			// $result=$con->query($query);
		}
		else {
			echo "songId was not passed to addPlays.php";
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

$adPlays=new addPlays();
$adPlays->send();
//$add2CuPlLi->select();
?>