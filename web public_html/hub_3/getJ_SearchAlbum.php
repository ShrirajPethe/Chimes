<?php

class Constants
{
//DATABASE DETAILS
	static $DB_SERVER="localhost";
	static $DB_NAME="id13654019_peacemusic";
	static $USERNAME="id13654019_sp";
	static $PASSWORD="KJF[N_%ym_t2b>K8";

//STATEMENTS
//	$albumId = $_GET['id'];

//    static $SQL_SELECT_ALL="SELECT * FROM songs WHERE album='".$albumId."' ORDER BY albumOrder ASC";
//    static $SQL_SELECT_ALL="SELECT * FROM albums";

}

class Salb
{
	/*******************************************************************************************************************************************/
/*
   1.CONNECT TO DATABASE.
   2. RETURN CONNECTION OBJECT
*/
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
   /*******************************************************************************************************************************************/
/*
   1.SELECT FROM DATABASE.
*/
   public function select()
   {
   	if(isset($_GET['term'])) {
   		$term = $_GET['term'];
   	}
   	else {
   		header("Location: index.php");
   	}
   	$con=$this->connect();
   	if($con != null)
   	{
		    $pdfs=array();
   		// "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10"
   		 $result=$con->query("SELECT * FROM albums WHERE title LIKE '%".$term."%' ");
   		 if($result->num_rows>0)
   		 {
   			   while($row=$result->fetch_array())
   			   {
                    $specar=$con->query("SELECT * FROM artists WHERE id='".$row['artist']."'");
                    $specge=$con->query("SELECT * FROM genres WHERE id='".$row['genre']."'");
                    if($specar->num_rows>0)
                    {
                        while($roart=$specar->fetch_array())
                        {
                            $artn = $roart['name'];
                        }
                    }else
                    {
                        print(json_encode(array("PHP ERROR : for artn")));
                    }
                   if($specge->num_rows>0)
                    {
                        while($rogen=$specge->fetch_array())
                        {
                            $genn = $rogen['name'];
                        }
                    }else
                    {
                        print(json_encode(array("PHP ERROR : for genn")));
                    }
               array_push($pdfs, array("id"=>$row['id'],"title"=>$row['title'],"artist"=>$artn,"genre"=>$genn,"artworkPath"=>$row['artworkPath']));

   				
   			}
   			print(json_encode($pdfs));
   		}else
   		{
   			print(json_encode(array("PHP EXCEPTION : CAN'T RETRIEVE FROM MYSQL. ")));
   		}
   		$con->close();

   	}else{
   		print(json_encode(array("PHP EXCEPTION : CAN'T CONNECT TO MYSQL. NULL CONNECTION.")));
   	}
   }
}



$salb=new Salb();
$salb->select();