<?php

//Connection
$con = mysqli_connect( "localhost", "id12149694_musica", "Imran54321", "id12149694_musicapp" );

/*Fn to check the connection*/
if (!$con){
    printf("Connection failed: %s\n", mysqli_connect_error());
    echo nl2br(" \n  \r\n ");
    echo(die('Could not connect: ' . mysqli_error()));
    exit();
}


/*Scan the directory for the files*/

$files = glob('{*.mp3,*.ogg,*.wav,*.flac}', GLOB_BRACE);

usort($files, function ($a, $b){
    return filemtime($a) < filemtime($b) ;
});

/*Insert List of files to db IF they don't exist already*/
$i = 0;

while ($files[$i]){
    echo nl2br(" \n  \r\n ");
    $trackname = basename($files[$i]);
    echo $trackname."****** \r\n ";

    // numlikes`, `numplays
    $addquery = "INSERT INTO music (Id,trackname,numlikes,numplays) VALUES (default,'$trackname',0,0)";

    if(mysqli_query($con, $addquery)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $addquery. " . mysqli_error($con);
    }

    echo $i;
    $i++;
}

?>