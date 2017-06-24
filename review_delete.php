<?php

include_once('config.php');

$review_no = $_POST['review_no'];

$b_sql = "DELETE FROM `review` WHERE `review_no` = ".$review_no;
$b_r = mysql_query($b_sql);
if(!$b_r){
	die("NO!");
}else{
	header("location: mypage.php");
}


?>