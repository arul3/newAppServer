<?php

session_start();

header('Access-Control-Allow-Origin:'.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods', 'POST,GET,OPTIONS,PUT,DELETE');

include 'database.php';

$db = new database;

$sender_id = $_SESSION['id'];

$receiver_id =$_REQUEST["id"];



date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream");
$counter = rand(1, 10); // a random counter
while (1) {
// 1 is always true, so repeat the while loop forever (aka event-loop)

$date = date("y:m:d",time());

$sql = "SELECT * FROM messages 
        WHERE (sender_id=$sender_id AND receiver_id =$receiver_id AND date='$date' AND sender_status ='unseen' ) 
        OR (sender_id=$receiver_id AND receiver_id =$sender_id AND date='$date' AND receiver_status ='unseen' ) LIMIT 1 OFFSET 0";


$result = $db->query($sql);

$no = mysqli_num_rows($result);
$lastTimeStamp= null ;

$messageID = null;
$messageSenderID = null;
$messageReceiverID = null;

$i =0;

$arr = array();


while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $i++;    

        $messageID = $row["message_id"];                         // message ID 
        $messageSenderID = $row["sender_id"];
        $messageReceiverID = $row["receiver_id"];

        $d = strtotime($row["timestamp"]);

        $time = date("h:i a",$d);
        $date_format = date("M d",$d);

        $row["date"] = $date_format;

        $row["time"] = $time;

        if($row["sender_id"] == $sender_id)
        {
            $row["type"] = "send";
        }else{
            $row["type"] = "receive";
        }


        

    array_push($arr,$row);
}

if($messageID == null)
{
 
}
else if(!changeStatus($messageID,$messageSenderID,$messageReceiverID))
    break;




  echo "event: ping\n",
       'data:'. json_encode($arr) ."\n\n";
  // Send a simple message at random intervals.




  // flush the output buffer and send echoed messages to the browser
  while (ob_get_level() > 0) {
    ob_end_flush();
  }
  flush();
  // break the loop if the client aborted the connection (closed the page)
  
  if ( connection_aborted() ) break;
  // sleep for 1 second before running the loop again
  
if($no > 0)
break;

  usleep(500000);


}


function changeStatus($messageID,$messageSenderID,$messageReceiverID)
{
  global $db;
  global $receiver_id;
  global $sender_id;

$sql = "";

 if($messageSenderID == $sender_id)
 {
     $sql = "UPDATE messages SET sender_status='seen' WHERE message_id = $messageID";
 }
 if( $messageReceiverID == $sender_id)
 {
     $sql = "UPDATE messages SET receiver_status='seen' WHERE message_id = $messageID";  

 }
    
     $res = $db->query($sql);

     if($res)
        return true;
      else{
        return false;
      }



}