<?php

session_start();

header('Content-Type: application/json');

include 'database.php';
include 'mainObject.php';

$db = new database;

//$user_id = 3;
if(!isset($_SESSION["id"]))
	die();

$user_id =$_SESSION["id"];


$sql = "SELECT * FROM user WHERE NOT user_id = $user_id";

$result = $db->query($sql);

$arr = array();


while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    

	$row["id"] = $row["user_id"];

	$row["lastMessage"] ="hello , welcom back...";

	$row["lastTime"] = "8:30 am";
  


    array_push($arr,$row);
}



$main = new mainObject;


$main->setLeftPanel($arr);

$main->setChatApp();
$main->setLoggedIn(true);


echo json_encode($main);




?>