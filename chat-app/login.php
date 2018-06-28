<?php

session_start();



header('Content-Type: application/json');

include 'database.php';

$request = json_decode(file_get_contents('php://input'));

$username = $request->username;

$password = $request->password;

$db = new database;

$sql = "SELECT * FROM user WHERE email ='$username' ";


$result = $db->query($sql);

$no = mysqli_num_rows($result);

$arr = array();

if($no == 1)
{
	$row  = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$_SESSION["id"] = $row["user_id"];

	$arr["loggedIn"] = true;
	$arr["dataLoaded"] = false;


	echo json_encode($arr);
}
else{

	$arr["loggedIn"] = false;
	$arr["dataLoaded"] = false;

	echo( json_encode($arr));
	}




?>