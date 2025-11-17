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

class Pdfs
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
        if(isset($_GET['id'])) {
            $genId = $_GET['id'];
        }
        else {
            header("Location: index.php");
        }
        $con=$this->connect();
        if($con != null)
        {
            $result=$con->query("SELECT * FROM songs WHERE genre='".$genId."' ORDER BY title ASC");
            if($result->num_rows>0)
            {
                $pdfs=array();
                while($row=$result->fetch_array())
                {
                    $specar=$con->query("SELECT * FROM artists WHERE id='".$row['artist']."'");
                    $spealb=$con->query("SELECT * FROM albums WHERE id='".$row['album']."'");
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

                    if($spealb->num_rows>0)
                    {
                        while($roalb=$spealb->fetch_array())
                        {
                            $albn = $roalb['title'];
                        }
                    }else
                    {
                        print(json_encode(array("PHP ERROR : for albn")));
                    }

                    array_push($pdfs, array("id"=>$row['id'],"title"=>$row['title'],"artist"=>$artn,"album"=>$albn,"genre"=>$row['genre'],"duration"=>$row['duration'],"path"=>$row['path'],"albumOrder"=>$row['albumOrder'],"plays"=>$row['plays']));
                }
                print(json_encode(array_reverse($pdfs)));
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

if(isset($_GET['id'])) {
	$genId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$pdfs=new Pdfs();
$pdfs->select();