<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/login.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript">
			$(window).on('load', function(){
				$("#login_form_btn").click(function(){
					$("#login_form").submit();
				});
			});
		</script>
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
							Manage
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
				<div class='login_wrapper'>
					<div class='login_header'>
						<span class='t_title'>
							Login
						</span>
						<br />
						<span class='t_body'>
							Welcome to megaCGV.
						</span>
					</div>
					<div class='login_body'>
						<div class='login_form_wrapper'>
							<form id='login_form' method='post' action='login_ok.php'>
								<div class='login_form_input_box'>
									<div class='login_form_inputs'>
										<div class='login_form_input_header'>
											ID
										</div>
										<div class='login_form_input_text'>
											<input type='text' name = 'uid'/>
										</div>
									</div>
									<div class='login_form_inputs'>
										<div class='login_form_input_header'>
											Password
										</div>
										<div class='login_form_input_text'>
											<input type='text' name='upwd' />
										</div>
									</div>
								</div>
								<div id='login_form_btn'>
									Login
								</div>
							</form>
						</div>
						<div class='join_btn'>
							<a href="join.php">Join</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>