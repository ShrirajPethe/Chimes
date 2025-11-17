<?php
//Connection
$con = mysqli_connect("localhost", "id13654019_sp", "KJF[N_%ym_t2b>K8", "id13654019_peacemusic");

if (!$con)
{
	echo(die('Could not connect: ' . mysqli_error()));
}

//query
$query = "SELECT * FROM songs ORDER BY RAND()";

if($result = mysqli_query($con,$query)){
	$i = 0 ;
	while($row = mysqli_fetch_row($result)){
		if($i == 0){
			echo "$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]";
		} else{
			echo "*$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]";
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