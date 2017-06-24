<?php
include_once('config.php');
$my_userno = (int)$_COOKIE['user_no'];
//echo $my_userno;

if($my_userno != "" && $_POST['point_select'] != ""){
	$sql="SELECT point FROM user WHERE user_no = $my_userno";
	$result=mysql_query($sql, $connect) or die("fault SQL");

	if($result){
		$row = mysql_fetch_assoc($result);

		$new_point = $row['point'] + $_POST['point_select'];

		$p_sql="UPDATE user SET point = $new_point WHERE user_no = $my_userno";
		$result=mysql_query($p_sql, $connect) or die("fault SQL2");
		if($result){
			header("location:mypage.php");
		}
		else{
			echo "fail";
		}

	}
	else{
		echo "fail";
	}
}
?>