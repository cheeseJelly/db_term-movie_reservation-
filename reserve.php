<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/reserve.css" />
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
						<?php
							if(isset($_COOKIE["is_admin"])&&($_COOKIE["is_admin"] == 1)){
								echo "<div class='menu_btn' id='manage_btn'>
							관리페이지
						</div>";
							}
						?>
						<div class='menu_btn' id='mypage_btn'>
							마이페이지
						</div>
						<?php
							if(!isset($_COOKIE["user_no"])){
								echo "<div class='menu_btn' id='login_btn'>
							<a href='./login.php'>로그인</a>
						</div>";
							} else{
								echo "<div class='menu_btn' id='logout_btn'>
								<a href='./logout.php'>로그아웃</a>
								</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class='contents'>
				<div>Reserve</div>
				<div class='reserve_form_wrapper'>
					<form id='reserve_form' method='post' action='reserve_withName.php'>
						<input type='text' id='m_name_id' name='m_name' />
						<input type='submit' value='submit' />
					</form>
				</div>

			</div>
			<div class='footer'>
				footer
			</div>
		</div>
	</body>
</html>