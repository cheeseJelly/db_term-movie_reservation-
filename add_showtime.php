<?php
include_once('config.php');

$movie_no = $_POST['movie_no'];
$theater_no = $_POST['theater_no'];
$startTime = $_POST['startTime'].":00";
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$sql = "INSERT INTO `showtime` (`movie_no`, `theater_no`, `startTime`, `start_date`, `end_date`) VALUES ( ".$movie_no.", ".$theater_no.", '".$startTime."', '".$start_date."', '".$end_date."')";

$result = mysql_query($sql);
if(!$result){
	die("Error!");

}else{
	header("location: manage.php");
}

?>