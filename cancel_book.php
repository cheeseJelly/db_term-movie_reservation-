<?php
	
include_once('config.php');

$booking_id = $_POST['booking_id'];

echo $booking_id;

$result = mysql_query("SET AUTOCOMMIT=0;");
$result = mysql_query("START TRANSACTION;");

$sql = "SELECT * FROM `booking_info` WHERE `booking_id` = ".$booking_id;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$ticket_id = $row['ticket_id'];

echo $ticket_id;

$success = true;

// remove booking_info
$b_sql = "DELETE FROM `booking_info` WHERE `booking_id` = ".$booking_id;
$b_r = mysql_query($b_sql);
if(!$b_r){
	echo $b_sql;
	echo "<br />ROLLBACK booking";
	$success = false;
}

// remove ticket_info
$t_sql = "DELETE FROM `ticket_info` WHERE `ticket_id` = ".$ticket_id;
$t_r = mysql_query($t_sql);
if(!$t_r){
	echo $t_sql;
	echo "<br />ROLLBACK ticket";
	$success = false;
}

if(!$success){
	mysql_query("ROLLBACK;");
	echo "Rollback!";
}else{
	mysql_query("COMMIT");
	echo "DONE!";
	header("location: mypage.php");
}


?>