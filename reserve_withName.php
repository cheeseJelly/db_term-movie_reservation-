<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
	
include_once('config.php');

$m_name = $_POST['m_name'];

?>
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
				<div>Reserve</div>
				<?php
					echo $m_name;
					$sql = "SELECT * FROM `movie` WHERE `title` LIKE '%".$m_name."%'";
					$result = mysql_query($sql);

					if(mysql_num_rows($result) == 0){
						echo "No results";
					}else{
						while($rows = mysql_fetch_assoc($result)){
							echo "<div class='movie_search_item'>";
							echo "<img src='".$rows['image_url']."' />";
							echo "<div class='movie_search_item_info'>";
							echo $rows['title']."(".$rows['year'].")";
							echo "</div>";
							echo "<div class='movie_search_item_info'>";
							$g_sql = "SELECT g.genre_type FROM `genre` g, `movie_genre` mg WHERE mg.movie_no = ".$rows['movie_no']." AND mg.genre_id = g.genre_id";
							$g_result = mysql_query($g_sql);
							while($g_rows = mysql_fetch_assoc($g_result)){
								echo $g_rows['genre_type']." ";
							}
							echo "</div>";
							$s_sql = "SELECT * FROM `showtime` s, `Theater` t WHERE s.movie_no = ".$rows['movie_no']." AND s.theater_no = t.theater_no";
							$s_result = mysql_query($s_sql);
							if(mysql_num_rows($s_result) == 0){
								echo "No available showtimes.";
							}else{
								while($s_rows = mysql_fetch_assoc($s_result)){
									echo "<div class='avail_showtimes'>";
									echo "Theater: ".$s_rows['theater_name']."&nbsp;&nbsp;";
									echo "Start time: ".$s_rows['startTime']."&nbsp;&nbsp;";
									echo "<form method='post' action='select_seat.php'>";
									echo "<input type='hidden' id='h_showtime_id' name='showtime_id' value='".$s_rows['showTime_id']."' />";
									echo "<input type='submit' value='좌석선택' />";
									echo "</form>";
									echo "</div>";
								}
							}
							echo "</div>";
						}
					}

				?>

			</div>
		</div>
	</body>
</html>