<?php
include_once('config.php');

$showtime_id = $_POST['showtime_id'];
$movie_no = $_POST['movie_no'];
$theater_no = $_POST['theater_no'];
$startTime = $_POST['startTime'].":00";
$show_date = $_POST['show_date'];

$sql = "UPDATE `showtime` SET `movie_no` = ".$movie_no.", `theater_no` = ".$theater_no.", `startTime` = '".$startTime."', `show_date` = '".$show_date."' WHERE `showTime_id` = ".$showtime_id;
$result = mysql_query($sql);

if(!$result){
	die("Error!");

}else{
	header("location: manage.php");
}

?>