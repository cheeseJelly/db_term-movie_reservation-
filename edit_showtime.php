<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
	
	include_once('config.php');

	$showTime_id = $_POST['showtime_id'];

	$sql = "SELECT * FROM `showtime` WHERE `showTime_id` = ".$showTime_id;
	$r = mysql_query($sql);
	$row = mysql_fetch_assoc($r);
	$movie_no = $row['movie_no'];
	$theater_no = $row['theater_no'];
	$startTime = $row['startTime'];
	$startTime = substr($startTime, 0, -3);
	$show_date = $row['show_date'];

?>
<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/manage.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type='text/javascript'>
			$(window).on('load', function(){
				var r = document.getElementById('movie_no');
				r.value = <?php echo $movie_no; ?>;
				var t = document.getElementById('theater_no');
				t.value = <?php echo $theater_no; ?>;

				$("#edit_showtime_btn").click(function(){
					var e = document.getElementById('movie_no');
					var movie_no = e.options[e.selectedIndex].value;

					var t = document.getElementById('theater_no');
					var theater_no = t.options[t.selectedIndex].value;

					var startTime = document.getElementById('startTime').value;
					var show_date = document.getElementById('show_date').value;

					if(movie_no != "" && theater_no != "" && startTime != "" && show_date != ""){
						$("#edit_showtime_form").submit();
					}

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
				<div class='manage_items'>
					<div class='manage_item'>
						<div class='manage_header'>
							Edit showtime
						</div>
						<form id='edit_showtime_form' method='post' action='edit_showtime_ok.php'>
							<input type='hidden' name='showtime_id' value='<?php echo $showTime_id ?>' />
							<div class='manage_input'>
								<div class='manage_input_header'>
									Movie : 
								</div>
								<div class='manage_input_input'>
									<select name='movie_no' id='movie_no'>
										<?php
											$sql = "SELECT * FROM `movie`";
											$r = mysql_query($sql);
											while($row = mysql_fetch_assoc($r)){
												$movie_no = $row['movie_no'];
												$movie_name = $row['title'];
												echo "<option value=".$movie_no.">".$movie_name."</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Theater : 
								</div>
								<div class='manage_input_input'>
									<select name='theater_no' id='theater_no'>
										<?php
											$sql = "SELECT * FROM `theater`";
											$r = mysql_query($sql);
											while($row = mysql_fetch_assoc($r)){
												$theater_no = $row['theater_no'];
												$theater_name = $row['theater_name'];
												echo "<option value=".$theater_no.">".$theater_name."</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									start time : 
								</div>
								<div class='manage_input_input'>
									<input type='time' name='startTime' id='startTime' value="<?php echo $startTime; ?>" />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									show date : 
								</div>
								<div class='manage_input_input'>
									<input type='date' name='show_date' id='show_date' value='<?php echo $show_date; ?>' />
								</div>
							</div>
						</form>
						<div class='manage_btn' id='edit_showtime_btn'>
							Edit showtime
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>