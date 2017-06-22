<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/login.css" />
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
				<div class='login_wrapper'>
					<div class='login_header'>
						<span class='t_title'>
							로그인
						</span>
						<br />
						<span class='t_body'>
							megacgv에 오신 것을 환영합니다.
						</span>
					</div>
					<div class='login_body'>
						<div class='login_form_wrapper'>
							<form method='post' action='login_ok.php'>
								<div class='login_form_input_box'>
									<div class='login_form_inputs'>
										<div class='login_form_input_header'>
											로그인ID
										</div>
										<div class='login_form_input_text'>
											<input type='text' name = 'uid'/>
										</div>
									</div>
									<div class='login_form_inputs'>
										<div class='login_form_input_header'>
											비밀번호
										</div>
										<div class='login_form_input_text'>
											<input type='text' name='upwd' />
										</div>
									</div>
								</div>
								<div class='login_form_btn'>
									<input type='submit' value='submit'>로그인
								</div>
							</form>
						</div>
						<div class='join_btn'>
							<a href="join.php">회원가입</a>
						</div>
					</div>
				</div>
			</div>
			<div class='footer'>
				Footer
			</div>
		</div>
	</body>
</html>