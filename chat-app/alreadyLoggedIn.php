<?php

session_start();



header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods', 'POST,GET,OPTIONS,PUT,DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, application/json');

header('Content-Type: application/json');

if(isset($_SESSION["id"]))
{

	echo '{ "loggedIn": true , "session" : '.$_SESSION["id"].'}';
}

else{
	echo '{ "loggedIn" : false}';
}


?>