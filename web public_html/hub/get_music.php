<?php
//Connection
$con = mysqli_connect("localhost", "id13505045_proxysp", "S/QopeognBe#p87}", "id13505045_slotify");

if (!$con)
{
	echo(die('Could not connect: ' . mysqli_error()));
}

//query
$query = "SELECT * FROM albums ORDER BY RAND() LIMIT 10";

if($result = mysqli_query($con,$query)){
	$i = 0 ;
	while($row = mysqli_fetch_row($result)){
		if($i == 0){
			echo "$row[0],$row[1],$row[2],$row[3],$row[4]";
		} else{
			echo "*$row[0],$row[1],$row[2],$row[3],$row[4]";
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