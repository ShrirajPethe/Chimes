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

class PtoQ
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


	public function imexport()
	{
		$con=$this->connect();
		if(isset($_POST['playlistId']) && isset($_POST['owner'])) {
			$playlistId = mysqli_real_escape_string($con,$_POST['playlistId']);
			$owner = mysqli_real_escape_string($con,$_POST['owner']);
		}
		else {
			header("Location: index.php");
			echo "owner or songId was not passed into addToPlaylist.php";
		}

		if($con != null)
		{
			$result=$con->query("SELECT * FROM playlistSongs WHERE playlistId='".$playlistId."' ORDER BY playlistOrder ASC");
			if($result->num_rows>0)
			{
				$pdfs=array();
				while($row=$result->fetch_array())
				{
					$songId = $row['songId'];

					$orderIdQuery = mysqli_query($con, "SELECT MAX(playlistOrder) + 1 as playlistOrder FROM currentPlayingList WHERE owner='".$owner."'");
					$row2 =  mysqli_fetch_array($orderIdQuery);

					$order = $row2['playlistOrder'];

					if (empty($order)) {
						$order = 0;
			  		// echo "Variable 'order' is empty.<br>" . $order;
					}

					$query = mysqli_query($con, "INSERT INTO currentPlayingList VALUES(NULL, '$songId', '$owner', '$order')")or die( $songId . $owner . $order . 'MySQL Error: '.mysqli_error($con).' ('.mysqli_errno($con).')' );
				}
			} else {
                    print(json_encode(array("PHP EXCEPTION : CAN'T RETRIEVE FROM MYSQL. ")));
			}
		}
	}
}

$shiftPtoQ=new PtoQ();
$shiftPtoQ->imexport();
?>