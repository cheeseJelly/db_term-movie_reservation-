<?php

include_once('config.php');

$user_no = $_COOKIE['user_no'];
$showtime_id = $_POST['showtime_id'];
$review_content = $_POST['content'];
$review_rating = $_POST['rating'];

// echo $showtime_id;
// echo $review_content;
// echo $review_rating;

$sql = "INSERT INTO `review` (`user_no`, `showTime_id`, `rating`, `content`) VALUES (".$user_no.", ".$showtime_id.", ".$review_rating.", '".$review_content."');";
$result = mysql_query($sql);
if(!$result){
	die("no");
}else{
	header("location: mypage.php");
}

?>