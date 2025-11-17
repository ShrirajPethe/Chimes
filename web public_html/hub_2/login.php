<?php 
require "conn.php";
$user_name = $_POST["user_name"];
$user_pass = $_POST["password"];

$user_pass = md5($user_pass);

$mysql_qry = "SELECT * FROM users where username like '$user_name' and password like '$user_pass';";
$result = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$fName = $row["firstName"];
	$lName = $row["lastName"];
	// echo "Login Successful! Welcome $user_name";
	echo "Login Successful! Welcome $fName $lName";
}
else {
	echo "Login Unsuccessful";
}

?>