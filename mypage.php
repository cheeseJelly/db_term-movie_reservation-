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
		<link rel="stylesheet" href="./css/mypage.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type='text/javascript'>
			function write_review(booking_id){
				var method = 'post';
				var form = document.createElement('form');
				form.setAttribute('method', method);
				form.setAttribute('action', 'write_review.php');

				var booking_id_input = document.createElement('input');
				booking_id_input.setAttribute('type', 'hidden');
				booking_id_input.setAttribute('name', 'booking_id');
				booking_id_input.setAttribute('value', booking_id);
				form.appendChild(booking_id_input);

				document.body.appendChild(form);
				form.submit();
			}
			function confirm_cancel(booking_id){
				var yes_no = confirm("Cancel this?");
				if(yes_no == true){
					var method = 'post';
					var form = document.createElement('form');
					form.setAttribute('method', method);
					form.setAttribute('action', 'cancel_book.php');

					var booking_id_input = document.createElement('input');
					booking_id_input.setAttribute('type', 'hidden');
					booking_id_input.setAttribute('name', 'booking_id');
					booking_id_input.setAttribute('value', booking_id);
					form.appendChild(booking_id_input);

					document.body.appendChild(form);
					form.submit();
				}
			}
			function edit_review(review_no){
				var method = 'post';
				var form = document.createElement('form');
				form.setAttribute('method', method);
				form.setAttribute('action', 'edit_review.php');

				var review_id_input = document.createElement('input');
				review_id_input.setAttribute('type', 'hidden');
				review_id_input.setAttribute('name', 'review_no');
				review_id_input.setAttribute('value', review_no);
				form.appendChild(review_id_input);

				document.body.appendChild(form);
				form.submit();
			}
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
				<div class='my_info mypage_infos'>
					<div class='my_info_header'>
						My information:
					</div>
					<div class='my_info_item'>
						ID: <?php echo $_COOKIE['user_id'];?>
					</div>
					<div class='my_info_item'>
						NAME: <?php echo $_COOKIE['user_name']; ?>
					</div>
				</div>
				<div class='info_reservations mypage_infos'>
					<div class='reservation_header'>
						My reservations:
					</div>
					<?php
						$user_no = $_COOKIE['user_no'];
						$sql = "SELECT * FROM `booking_info`b, `ticket_info`t, `showtime`s WHERE b.user_no = ".$user_no." AND b.ticket_id = t.ticket_id AND s.showTime_id = t.showtime_id";
						$result = mysql_query($sql);
						while($rows = mysql_fetch_assoc($result)){
							$msql = "SELECT * FROM movie WHERE movie_no = ".$rows['movie_no'];
							$mresult = mysql_query($msql);
							$mrow = mysql_fetch_assoc($mresult);

							$tsql = "SELECT * FROM Theater WHERE theater_no =".$rows['theater_no'];
							$tresult = mysql_query($tsql);
							$trow = mysql_fetch_assoc($tresult);

							echo "<div class='reservation_item'>";
							echo "<div class='reservation_item_info'>";
							echo "movie title : ".$mrow['title']."&nbsp;&nbsp;";
							echo "theater : ".$trow['theater_name']."&nbsp;&nbsp;";
							echo "Start time : ".$rows['startTime']."&nbsp;&nbsp;";
							echo "Seat No : ".$rows['seat_no']."&nbsp;&nbsp;";
							echo "</div>";
							echo "<div class='reservation_item_btns'>";
							echo "<div class='mypage_btns' onclick='write_review(".$rows['booking_id'].");'>";
							echo "Write review";
							echo "</div>";
							echo "<div class='mypage_btns' onclick='confirm_cancel(".$rows['booking_id'].");'>";
							echo "Cancel this";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
					?>
				</div>
				<div class='info_points mypage_infos'>
					My Points: 
					<?php
						$user_no = (int)$_COOKIE['user_no'];
						$sql = "SELECT `point` FROM user WHERE `user_no` = ".$user_no;
						$result = mysql_query($sql, $connect) or die("fault SQL");
						$row = mysql_fetch_assoc($result);
						echo $row['point'];
					?>
					<a href='./point.php'>Buy points</a>
				</div>
				<div class='info_reviews mypage_infos'>
					<div class='review_headers'>
						My REVIEWs:
					</div>
					<?php
						$user_no = $_COOKIE['user_no'];
						$sql = "SELECT * FROM `review` WHERE `user_no` = ".$user_no;
						$result = mysql_query($sql);
						while($row = mysql_fetch_assoc($result)){
							$showtime_id = $row['showTime_id'];
							$r_sql = "SELECT * FROM `showtime` st, `movie` m, `theater` t WHERE st.showTime_id = ".$showtime_id." AND st.movie_no = m.movie_no AND st.theater_no = t.theater_no";
							$r_result = mysql_query($r_sql);
							$r_rows = mysql_fetch_assoc($r_result);

							echo "<div class='review_item'>";
							echo "<div class='review_item_info'>";
							echo "Movie title : ".$r_rows['title']."&nbsp;&nbsp;";
							echo "theater : ".$r_rows['theater_name']."&nbsp;&nbsp;";
							echo "Start time : ".$r_rows['startTime']."&nbsp;&nbsp;";
							echo "</div>";
							echo "<div class='review_item_info'>";
							echo "Rating : ".$row['rating']."&nbsp;//&nbsp;";
							echo "Review : ".$row['content'];
							echo "</div>";
							echo "<div class='review_item_btns'>";
							echo "<div class='mypage_btns' onclick='edit_review(".$row['review_no'].");'>";
							echo "Edit review";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>