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
            $plyID = $_GET['id'];
        }
        else {
            header("Location: index.php");
        }
        $con=$this->connect();
        if($con != null)
        {
            $result=$con->query("SELECT * FROM playlistSongs WHERE playlistId='".$plyID."' ORDER BY playlistOrder ASC");
            if($result->num_rows>0)
            {
                $pdfs=array();
                while($row=$result->fetch_array())
                {
                    $resu2=$con->query("SELECT * FROM songs WHERE id= '".$row['songId']."' ");
                    if($resu2->num_rows>0)
                    {
                        // $pdfs=array();
                        while($row2=$resu2->fetch_array())
                        {
                            $specar=$con->query("SELECT * FROM artists WHERE id='".$row2['artist']."'");
                            $spealb=$con->query("SELECT * FROM albums WHERE id='".$row2['album']."'");
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
                            array_push($pdfs, array("id"=>$row2['id'],"title"=>$row2['title'],"artist"=>$artn,"album"=>$albn,"genre"=>$row2['genre'],"duration"=>$row2['duration'],"path"=>$row2['path'],"albumOrder"=>$row2['albumOrder'],"plays"=>$row2['plays']));
                        }
                    }
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
    $plyID = $_GET['id'];
}
else {
    header("Location: index.php");
}

$pdfs=new Pdfs();
$pdfs->select();