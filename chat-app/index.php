<?php

header('Access-Control-Allow-Origin: *');

include 'database.php';

$db = new database;

$sender_id = 1;

$receiver_id =2;



$date = date("y:m:d",time());

$sql = "SELECT * FROM messages WHERE (sender_id=$sender_id AND receiver_id =$receiver_id AND date='$date') OR (sender_id=$receiver_id AND receiver_id =$sender_id AND date='$date') ";


$result = $db->query($sql);



$arr = array();


while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    

        $d = strtotime($row["timestamp"]);

        $time = date("h:i a",$d);
        $date_format = date("M d",$d);

        $row["date"] = $date_format;

        $row["time"] = $time;

        if($row["sender_id"] == 1)
        {
            $row["type"] = "send";
        }else{
            $row["type"] = "receive";
        }

    array_push($arr,$row);
}



echo json_encode($arr);

?>