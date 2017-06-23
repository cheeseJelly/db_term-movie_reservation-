<?php
	
include_once('config.php');

$seat_no = $_POST['seat_no'];
$showtime_id = $_POST['showtime_id'];
$ticket_type = $_POST['ticket_type'];
$user_no = $_COOKIE['user_no'];

$success = true;

$result = mysql_query("SET AUTOCOMMIT=0", $connect);
$result = mysql_query("BEGIN", $connect);

// Add ticket info to make ticket_id
$t_sql = "INSERT INTO `ticket_info` (`showtime_id`, `seat_no`, `type_id`, `price`) VALUES ( $showtime_id, $seat_no, $ticket_type, 3000)";
$result = mysql_query($t_sql, $connect);
if(!$result || mysql_affected_rows($result) == 0) $success = false;
$t_id_sql = "SELECT * FROM `ticket_info` where `showtime_id` = ".$showtime_id." AND $seat_no='".$seat_no;
$t_id_result = mysql_query($t_id_sql);
echo "HO!";
while($rows = mysql_fetch_assoc($t_id_result)){
	echo $rows['ticket_id'];
}
$ticket_id = mysql_fetch_assoc($t_id_result)['ticket_id'];

echo "Done\n";
echo $success."\n";
echo $ticket_id;

// Add booking info to make booking id

$b_sql = "INSERT INTO `booking_info` (`ticket_id`, `user_no`) VALUES ( $ticket_id, $user_no )";

echo $t_sql;
echo $b_sql;
// echo $seat_no;
// echo $showtime_id;
// echo $_COOKIE['user_no'];



?>