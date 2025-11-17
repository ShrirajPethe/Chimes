<?php
ob_start();
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");

//	$con = mysqli_connect("localhost", "id13505045_proxysp", "S/QopeognBe#p87}", "id13505045_slotify");
//  $con = mysqli_connect("localhost", "id13505045_proxysp", "S/QopeognBe#p87}", "id13505045_slotify");

$db_name = "id13654019_peacemusic";
$mysql_username = "id13654019_sp";
$mysql_password = "KJF[N_%ym_t2b>K8";
$server_name = "localhost";
// $conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);

$con = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);

if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}
else
{
	  //  echo "seems to be no errors<br>connection sucessfull";
}
?>