<?php

include_once('config.php');

$user_no = $_COOKIE['user_no'];
$review_no = $_POST['review_no'];
$showtime_id = $_POST['showtime_id'];
$review_content = $_POST['content'];
$review_rating = $_POST['rating'];

// echo $review_no;
// echo $showtime_id;
// echo $review_content;
// echo $review_rating;

$sql = "UPDATE `review` SET `rating` = ".$review_rating.", `content` = '".$review_content."' WHERE `review_no`=".$review_no;
$result = mysql_query($sql);

if(!$result){
	die("no");
}else{
	header("location: mypage.php");
}

?>