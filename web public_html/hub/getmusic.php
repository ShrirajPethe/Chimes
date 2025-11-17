<?php

//Connection
$con = mysqli_connect( "localhost", "id12149694_musica", "Imran54321", "id12149694_musicapp" );

/*Fn to check the connection*/
if (!$con)
{
echo(die('Could not connect: ' . mysqli_error()));
}

/*query */
$query = "SELECT * FROM music ORDER BY Id DESC";


if($result = mysqli_query($con,$query)){
    $i = 0 ;
    while($row = mysqli_fetch_row($result)){
        if($i == 0){
            echo "$row[0],$row[1],$row[2],$row[3]";
        } else{
            echo "*$row[0],$row[1],$row[2],$row[3]";
        }
        $i++;
    }
    mysqli_free_result($result);
    // echo "Records inserted successfully.";

} else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
    if (!mysqli_query($con, $query)) {
    printf("Error message: %s", mysqli_error($con));
    }
}

mysqli_close($con);

?>