<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/join.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
	</head>
	<body>
		<div class='container'>
			<div class='header'>
				<div class='navigation'>
					<div class='logo'>
						LOGO
					</div>
					<div class='menu_bar'>
						<div class='menu_btn' id='reserve_btn'>
							<a href='./reserve.php'>
								Reserve
							</a>
						</div>
						<?php
							if(isset($_COOKIE["is_admin"])&&($_COOKIE["is_admin"] == 1)){
								echo "<div class='menu_btn' id='manage_btn'>
							<a href='./manage.php'>Manage</a>
						</div>";
							}
						?>
						<div class='menu_btn' id='mypage_btn'>
							<a href='./mypage.php'>
								Mypage
							</a>
						</div>
						<?php
							if(!isset($_COOKIE["user_no"])){
								echo "<div class='menu_btn' id='login_btn'>
							<a href='./login.php'>Login</a>
						</div>";
							} else{
								echo "<div class='menu_btn' id='logout_btn'>
								<a href='./logout.php'>Logout</a>
								</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class='contents'>
			<form name = "join" action="join_confirm.php" method="post">
			<table border = "1">
			<tr>
			<td>ID</td>
			<td><input type="text" size = "30" name="id"></td>
			</tr>
			<tr>
			<td>Password></td>
			<td><input type="password" size = "30" name="pwd"></td>
			</tr>
			<tr>
			<td>name</td>
			<td><input type="text" size="12" maxlength = "10" name="name"></td>
			</tr>
			<tr>
			<td>admin confirm text</td>
			<td><input type="text" size = "12" name = "is_admin"></td>
			</tr>
			</table>
			<input type="submit" value ="submit">
			<input type="reset" value="rewrite">
			</form>
			</div>
		</div>
	</body>
</html>
