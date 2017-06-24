<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
include_once('config.php');

$showtime_id = $_POST['showtime_id'];

?>
<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/seats.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type='text/javascript'>
			function check_seat(obj){
				if(obj.className.includes('booked')){
					window.alert('Error!');
				}else{
					var seat_no = obj.innerHTML;
					var yes_no = confirm("Reserve seat " + seat_no);
					if(yes_no == true){
						// Reserve this
						// send a form with showtime_id and seat_no
						method = 'post';

						var form = document.createElement('form');
						form.setAttribute('method', method);
						form.setAttribute('action', 'reserve_seat.php');

						var showtime_id_input = document.createElement('input');
						showtime_id_input.setAttribute('type', 'hidden');
						showtime_id_input.setAttribute('name', 'showtime_id');
						showtime_id_input.setAttribute('value', <?php echo "'".$showtime_id."'"; ?>)
						form.appendChild(showtime_id_input);

						var seat_no_input = document.createElement('input');
						seat_no_input.setAttribute('type', 'hidden');
						seat_no_input.setAttribute('name', 'seat_no');
						seat_no_input.setAttribute('value', seat_no);
						form.appendChild(seat_no_input);

						var ticket_type = document.createElement('input');
						ticket_type.setAttribute('type', 'hidden');
						ticket_type.setAttribute('name', 'ticket_type');
						ticket_type.setAttribute('value', 1);
						form.appendChild(ticket_type);

						document.body.appendChild(form);
						form.submit();
					}else{
						// No
					}
				}
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
				<div>Select seat</div>
				<?php
					echo "Showtime ID: ".$showtime_id."<br />";

					$t_sql = "SELECT * FROM `showtime` st, `theater` t WHERE st.showTime_id =".$showtime_id." AND st.theater_no = t.theater_no";
					$t_result = mysql_query($t_sql);
					$t_row = mysql_fetch_assoc($t_result);
					echo "In theater ".$t_row['theater_name'];

					$booked_seats = array();

					$b_sql = "SELECT * FROM `ticket_info` WHERE `showtime_id` = ".$showtime_id;
					$b_result = mysql_query($b_sql);
					while($b_rows = mysql_fetch_assoc($b_result)){
						$booked_seats[] = $b_rows['seat_no'];
					}

					for($i=0; $i<$t_row['max_row']; $i++){
						echo "<div class='seats_row'>";
						for($j=1; $j<=$t_row['max_col']; $j++){
							$seat_no = chr($i+65).$j;
							if(in_array($seat_no, $booked_seats)){
								echo "<div class='seats booked'>";
							}else{
								echo "<div class='seats' onclick='check_seat(this);'>";
							}
							echo $seat_no;
							echo "</div>";
						}
						echo "</div>";
					}





				?>
			</div>
		</div>
	</body>
</html>