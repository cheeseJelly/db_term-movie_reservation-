<?php
	
include_once('config.php');

$seat_no = $_POST['seat_no'];
$showtime_id = $_POST['showtime_id'];
$ticket_type = $_POST['ticket_type'];
$user_no = $_COOKIE['user_no'];


// Add ticket info to make ticket_id
$t_t_sql = "SELECT * FROM `ticket_type` WHERE `type_id` = ".$ticket_type;
$t_t_result = mysql_query($t_t_sql);
$rows = mysql_fetch_assoc($t_t_result);
$discount = $rows['discount'];
$price = 3000-$discount;

$success = true;

$result = mysql_query("SET AUTOCOMMIT=0;");
$result = mysql_query("START TRANSACTION;");

// check points > price
$u_sql = "SELECT * FROM `user` WHERE `user_no` = ".$user_no;
$u_r = mysql_query($u_sql);
if(!$u_r){
	//	mysql_query("rollback;");
	echo $u_sql;
	echo "<br />ROLLBACK here";
	$success = false;	
}else{
	$row = mysql_fetch_assoc($u_r);
	$avail_point = $row['point'];
	if($avail_point < $price){
		echo "POINT is too low.";
		//echo "ROLLBACK";
		$success = false;
	}else{
		// update point
		$after_point = $avail_point - $price;
		$p_sql = "UPDATE `user` SET `point` = '".$after_point."' WHERE `user_no` = ".$user_no;
		$p_r = mysql_query($p_sql);
		if(!p_r){
			echo $p_sql;
			echo "ROLLBACK";
			$success = false;
		}
	}
}

$t_sql = "INSERT INTO `ticket_info` (`showtime_id`, `seat_no`, `type_id`, `price`) VALUES ( ".$showtime_id.", '".$seat_no."', ".$ticket_type.", ".$price.")";
$t_r = mysql_query($t_sql);
if(!$t_r){
	//	mysql_query("rollback;");
	echo $t_sql;
	echo "<br />ROLLBACK here";
	$success = false;
	exit;	
} 

$t_id_sql = "SELECT LAST_INSERT_ID();";
$t_id_result = mysql_query($t_id_sql);
if(!$t_id_result){
	echo $t_id_sql;
	exit;
}else{
	$ticket_array = mysql_fetch_array($t_id_result);
	$ticket_id = $ticket_array[0];
}

// Add booking info to make booking id

$b_sql = "INSERT INTO `booking_info` (`ticket_id`, `user_no`) VALUES ( $ticket_id, $user_no )";

$b_result = mysql_query($b_sql);
if(!$b_result){
	//	mysql_query("rollback");
	echo $b_sql;
	echo "<br />ROLLBACK here";
	$success = false;
}

if(!$success){
	mysql_query("ROLLBACK;");
	//echo "Rollback!";
}else{
	mysql_query("COMMIT");
	//echo "DONE!";
	//echo "<script>alert('Reservation is done!');</script>";
	header("location: index.php");
}


?>