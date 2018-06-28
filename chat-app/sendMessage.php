<?php

session_start();



header('Content-Type: application/json');

include 'database.php';

$db = new database;

$user_id = $_SESSION["id"];

$user = json_decode(file_get_contents('php://input'));

$message = $user->message;

$receiver_id =  $user->id;

$sql = "INSERT INTO messages(message_id,sender_id,receiver_id,message,date,time,timestamp,status,sender_status,receiver_status) VALUE (null,$user_id,$receiver_id,'$message',CURDATE(),CURTIME(),NOW(),'unseen','unseen','unseen')";



$result = $db->query($sql);

if($result)
{
	echo '{ "status" : "success" }';
}



  ?>