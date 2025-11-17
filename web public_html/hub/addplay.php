<?php

//Connection
$con = mysqli_connect( "localhost", "id12149694_musica", "Imran54321", "id12149694_musicapp" );

/*Fn to check the connection*/
if (!$con)
{
echo(die('Could not connect: ' . mysqli_error()));
}

//


$incomingdata = $_SERVER['QUERY_STRING'];
$data = substr($incomingdata, strpos($incomingdata, 'id=')+3) ;

//preventing sql injections
$id = mysqli_real_escape_string($con, $data);

echo "$id";

$query = "UPDATE music SET numplays = numplays + 1 WHERE Id = '$id'" ;

mysqli_query($con, $query);


///mysqli_close($con);

?>