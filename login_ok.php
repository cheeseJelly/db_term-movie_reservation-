<?php
include_once('config.php');
$connect = mysql_connect($host, $user, $pw); 

if(!$connect){
	 die('Could not connect: ' . mysql_error());
}

mysql_select_db($dbName, $connect) or die('could not select db');


if($_POST["uid"] != ""){  // uid값이 있으면
	$myusername=$_POST["uid"];
	$mypassword=$_POST["upwd"]; 

	$sql="SELECT * FROM user WHERE id = '".$myusername."' AND password = '".$mypassword."'";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	if($count==1){
		$rows = mysql_fetch_assoc($result);
		//echo $rows["name"];
		//echo $rows["user_no"];
		setcookie("user_id", $myusername, time() + 3600);
		setcookie("user_name",$rows['name'], time()+3600);
		setcookie("user_no", $rows['user_no'], time()+3600);
		setcookie("is_admin", $rows['is_admin'], time()+3600);
		header("location: index.php");
	}
	else{
		$error="Your Login Name or Password is invalid";
	}
}

mysql_close($connect);
?>