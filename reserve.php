<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
?>
<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/reserve.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type='text/javascript'>
			$(window).on('load', function(){
				$("#search_movie_btn").click(function(){
					$("#search_form").submit();
				});

				$("#detail_search_btn").click(function(){
					$("#detail_search_form").submit();
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
				<div class='reserve_items'>
					<div class='reserve_item'>
						<div class='reserve_header'>
							Search movie
						</div>
						<form id='search_form' method='post' action='reserve_withName.php'>
							<div class='reserve_input'>
								<div class='reserve_input_header'>
									Title : 
								</div>
								<div class='reserve_input_input'>
									<input type='text' id='m_name_id' name='m_name' />
								</div>
							</div>
						</form>
						<div class='reserve_btn' id='search_movie_btn'>
							Search movie
						</div>
					</div>
					<div class='reserve_item'>
						<div class='reserve_header'>
							Detail Search
						</div>
						<form id='detail_search_form' method='post' action='reserve_detail.php'>
							<div class='reserve_input'>
								<div class='reserve_input_header'>
									Title : 
								</div>
								<div class='reserve_input_input'>
									<input type='text' id='m_name_id' name='m_name' />
								</div>
							</div>
							<div class='reserve_input'>
								<div class='reserve_input_header'>
									Director : 
								</div>
								<div class='reserve_input_input'>
									<input type='text' id='m_director' name='m_director' />
								</div>
							</div>
						</form>
						<div class='reserve_btn' id='detail_search_btn'>
							Detail Search
						</div>
					</div>
				</div>

			</div>
		</div>
	</body>
</html>