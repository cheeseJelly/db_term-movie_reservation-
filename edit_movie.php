<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
	
	include_once('config.php');

	$movie_no = $_POST['movie_no2'];

	$sql = "SELECT * FROM `movie` m, `movie_director` md, `people` p WHERE m.`movie_no` = ".$movie_no." AND m.`movie_no` = md.`movie_no` AND md.`people_id` = p.`people_id`";
	$r = mysql_query($sql);
	$rows = mysql_fetch_assoc($r);
	$title = $rows['title'];
	$year = $rows['year'];
	$playMinutes = $rows['playMinutes'];
	$director_name = $rows['name'];

	$a_sql = "SELECT * FROM `movie` m, `movie_actor` ma, `people` p WHERE m.`movie_no` = ".$movie_no." AND m.`movie_no` = ma.`movie_no` AND ma.`people_id` = p.`people_id`";
	$actors = "";
	$a_r = mysql_query($a_sql);
	while($a_rows = mysql_fetch_assoc($a_r)){
		$actors = $actors.$a_rows['name'].",";
	}
	$actors = substr($actors, 0, -1);

	$g_sql = "SELECT * FROM `movie` m, `movie_genre` mg, `genre` g WHERE m.`movie_no` = ".$movie_no." AND m.`movie_no` = mg.`movie_no` AND mg.`genre_id` = g.`genre_id`";
	$genres = "";
	$g_r = mysql_query($g_sql);
	while($g_rows = mysql_fetch_assoc($g_r)){
		$genres = $genres.$g_rows['genre_type'].",";
	}
	$genres = substr($genres, 0, -1);

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
				$("#edit_movie_btn").click(function(){
					var title = document.getElementById('movie_title').value;
					var year = document.getElementById('movie_year').value;
					var playMinutes = document.getElementById('movie_playMinutes').value;
					var genre = document.getElementById('movie_genre').value;
					var director = document.getElementById('movie_director').value;
					var actor = document.getElementById('movie_actor').value;
					if(title != "" && year != "" && playMinutes != "" && genre != "" && director != "" && actor != ""){
						$("#edit_movie_form").submit();
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
							Edit movie
						</div>
						<form id='edit_movie_form' method='post' action='edit_movie_ok.php'>
							<input type='hidden' name='movie_no' value='<?php echo $movie_no; ?>' />
							<div class='manage_input'>
								<div class='manage_input_header'>
									Title : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_title' id='movie_title' value='<?php echo $title; ?>' />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Year : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_year' id='movie_year' value='<?php echo $year; ?>'  />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Playtime : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_playMinutes' id='movie_playMinutes' value='<?php echo $playMinutes; ?>'  />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Genre : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_genre' id='movie_genre' value='<?php echo $genres; ?>'  />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Director : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_director' id='movie_director' value='<?php echo $director_name; ?>'  />
								</div>
							</div>
							<div class='manage_input'>
								<div class='manage_input_header'>
									Actor : 
								</div>
								<div class='manage_input_input'>
									<input type='text' name='movie_actor' id='movie_actor' value='<?php echo $actors; ?>'  />
								</div>
							</div>
						</form>
						<div class='manage_btns'>
							<div class='manage_btn' id='edit_movie_btn'>
								Edit movie
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>