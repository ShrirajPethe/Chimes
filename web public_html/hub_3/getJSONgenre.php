<?php

class Constants
{
    //DATABASE DETAILS
    static $DB_SERVER="localhost";
    static $DB_NAME="id13654019_peacemusic";
    static $USERNAME="id13654019_sp";
    static $PASSWORD="KJF[N_%ym_t2b>K8";

    //STATEMENTS
    static $SQL_SELECT_ALL="SELECT * FROM genres";

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
        $con=$this->connect();
        if($con != null)
        {
            $result=$con->query(Constants::$SQL_SELECT_ALL);
            if($result->num_rows>0)
            {
                $pdfs=array();
                while($row=$result->fetch_array())
                {
                    // $specar=$con->query("SELECT * FROM artists WHERE id='".$row['artist']."'");
                    // $specge=$con->query("SELECT * FROM genres WHERE id='".$row['genre']."'");
/*
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
*/
                    
                    array_push($pdfs, array("id"=>$row['id'],"name"=>$row['name']));
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
$pdfs=new Pdfs();
$pdfs->select();