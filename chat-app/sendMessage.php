<?php

session_start();

header('Access-Control-Allow-Origin:'.$_SERVER['HTTP_ORIGIN']);
//header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods', 'POST,GET,OPTIONS,PUT,DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, application/json');

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