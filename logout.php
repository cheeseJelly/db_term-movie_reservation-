<?php
	if(isset($_COOKIE['user_no'])){
		setcookie("user_no", "", time()-3600);
		setcookie("user_name", "", time()-3600);
		setcookie("user_id", "", time()-3600);
		setcookie("is_admin", "", time()-3600);
		// echo "Logout";
		// echo $_COOKIE['user_no'];
		header("location: index.php");
	}else{
		echo "No!";
	}
?>