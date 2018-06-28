<?php

session_start();


header('Content-Type: application/json');

if(isset($_SESSION["id"]))
{

	echo '{ "loggedIn": true , "session" : '.$_SESSION["id"].'}';
}

else{
	echo '{ "loggedIn" : false}';
}


?>