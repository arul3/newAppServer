<?php
session_start(); 
session_destroy();

header('Access-Control-Allow-Origin:*');
//header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods', 'POST,GET,OPTIONS,PUT,DELETE');
header('Content-Type: application/json');

echo '{ "logout" : true }';
?>