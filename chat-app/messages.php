<?php

session_start();




header('Content-Type: application/json');

include 'database.php';
include 'messageByDate.php';

$db = new database;



$sender_id = $_SESSION["id"];

$user = json_decode(file_get_contents('php://input'));



$receiver_id =  $user->id;


$sql = "SELECT DISTINCT date FROM messages 
        WHERE (sender_id = $sender_id AND receiver_id = $receiver_id AND sender_status = 'seen')  
        OR  (sender_id = $receiver_id AND receiver_id = $sender_id AND  receiver_status ='seen')
         ORDER BY date ASC ";


$result = $db->query($sql);


$data =  array();


while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    

		$date = $row["date"];
		$date_format ;
		
		$sql2 = "SELECT * FROM messages
         WHERE (sender_id=$sender_id AND receiver_id =$receiver_id AND date='$date' AND sender_status = 'seen')
          OR (sender_id=$receiver_id AND receiver_id =$sender_id AND date='$date'  AND receiver_status ='seen') ORDER BY time ASC  ";


$result2 = $db->query($sql2);



$arr = array();


while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
    

        $d = strtotime($row2["timestamp"]);

        $time = date("h:i a",$d);
        $date_format = date("d M",$d);

        $row2["date"] = $date_format;

        $row2["time"] = $time;

        if($row2["sender_id"] ==  $sender_id)
        {
            $row2["type"] = "send";
        }else{
            $row2["type"] = "receive";
        }

    array_push($arr,$row2);
}


		$messagesByDate = new messageByDate($date_format,$arr);

		array_push($data,$messagesByDate);

}


	echo json_encode($data);

?>