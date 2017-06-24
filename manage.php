<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
	
include_once('config.php');

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
				$("#add_movie_btn").click(function(){
					var title = document.getElementById('movie_title').value;
					var year = document.getElementById('movie_year').value;
					var playMinutes = document.getElementById('movie_playMinutes').value;
					var genre = document.getElementById('movie_genre').value;
					var director = document.getElementById('movie_director').value;
					var actor = document.getElementById('movie_actor').value;
					var image = document.getElementById('movie_image').value;
					if(title != "" && year != "" && playMinutes != "" && genre != "" && director != "" && actor != ""){
						$("#add_movie_form").submit();
					}
				});

				$("#add_showtime_btn").click(function(){
					var e = document.getElementById('movie_no');
					var movie_no = e.options[e.selectedIndex].value;

					var t = document.getElementById('theater_no');
					var theater_no = t.options[t.selectedIndex].value;

					var startTime = document.getElementById('startTime').value;
					var show_date = document.getElementById('show_date').value;

					if(movie_no != "" && theater_no != "" && startTime != "" && show_date != ""){
						$("#add_showtime_form").submit();
					}

				});

				$("#edit_movie_btn").click(function(){
					$("#edit_movie_form").submit();
				});

				$("#edit_showtime_btn").click(function(){
					$("#edit_showtime_form").submit();
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
							ADD movie
						</div>
						<form id='add_movie_form' method='post' action='add_movie.php'>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Title : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_title' id='movie_title' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Year : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_year' id='movie_year' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Playtime : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_playMinutes' id='movie_playMinutes' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Genre : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_genre' id='movie_genre' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Director : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_director' id='movie_director' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Actor : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_actor' id='movie_actor' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Image : 
								</div>
								<div class='manage_input_input'>
    								<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
									<input type='file' name='movie_image' id='movie_image' />
								</div>
							</div>
						</form>
						<div class='manage_btn' id='add_movie_btn'>
							Add movie
						</div>
					</div>
					<div class='manage_item'>
						<div class='manage_header'>
							Edit movie
						</div>
						<form id='edit_movie_form' method='post' action='edit_movie.php'>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Movie :
								</div>
								<div class='manage_input_input'>
									<select name='movie_no2' id='movie_no2'>
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
						</form>
						<div class='manage_btn' id='edit_movie_btn'>
							Edit movie
						</div>
					</div>
					<div class='manage_item'>
						<div class='manage_header'>
							ADD showtime
						</div>
						<form id='add_showtime_form' method='post' action='add_showtime.php'>
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
									<input type='time' name='startTime' id='startTime' value="<?php $date = date('H:i', strtotime($row['time_d'])); echo $date; ?>" />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									show date : 
								</div>
								<div class='manage_input_input'>
									<input type='date' name='show_date' id='show_date' value='<?php echo date("Y-m-j"); ?>' />
								</div>
							</div>
						</form>
						<div class='manage_btn' id='add_showtime_btn'>
							ADD showtime
						</div>
					</div>
					<div class='manage_item'>
						<div class='manage_header'>
							Edit showtime
						</div>
						<form id='edit_showtime_form' method='post' action='edit_showtime.php'>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Showtime :
								</div>
								<div class='manage_input_input'>
									<select name='showtime_id' id='showtime_id'>
										<?php
											$sql = "SELECT * FROM `movie` m, `showtime` s, `theater` t WHERE s.movie_no = m.movie_no AND t.theater_no = s.theater_no";
											$r = mysql_query($sql);
											while($row = mysql_fetch_assoc($r)){
												$showtime_text = "Movie '".$row['title']."' - theater '".$row['theater_name']."' ".$row['show_date']." ".$row['startTime'];
												echo "<option value=".$row['showTime_id'].">".$showtime_text."</option>";
											}
										?>
									</select>
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