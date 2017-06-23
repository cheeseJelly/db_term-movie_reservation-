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
							예매하기
						</div>
						<div class='menu_btn' id='eval_btn'>
							평가하기
						</div>
						<div class='menu_btn' id='manage_btn'>
							관리페이지
						</div>
						<div class='menu_btn' id='mypage_btn'>
							마이페이지
						</div>
						<div class='menu_btn' id='login_btn'>
							로그인
						</div>
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
