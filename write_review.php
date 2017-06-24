<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
	
include_once('config.php');

$booking_id = $_POST['booking_id'];
$user_no = $_COOKIE['user_no'];

$sql = "SELECT * FROM `booking_info` bi, `ticket_info` ti WHERE bi.booking_id = ".$booking_id." AND bi.ticket_id = ti.ticket_id";
$result = mysql_query($sql);
$rows = mysql_fetch_assoc($result);
$showtime_id = $rows['showtime_id'];

?>
<html>
	<head>
		<title>megacgv</title>
		<link rel="stylesheet" href="./css/reset.css" />
		<link rel="stylesheet" href="./css/header.css" />
		<link rel="stylesheet" href="./css/review.css" />
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type='text/javascript'>
			$(window).on('load', function(){
				$("#review_write_btn").click(function(){
					var method = 'post';
					var form = document.createElement('form');
					form.setAttribute('method', method);
					form.setAttribute('action', 'review_ok.php');

					var showtime_id = document.createElement('input');
					showtime_id.setAttribute('type', 'hidden');
					showtime_id.setAttribute('name', 'showtime_id');
					showtime_id.setAttribute('value', <?php echo $showtime_id; ?>);
					form.appendChild(showtime_id);

					var e = document.getElementById('review_rating');
					var rating_val = e.options[e.selectedIndex].value;
					var rating_input = document.createElement('input');
					rating_input.setAttribute('type', 'hidden');
					rating_input.setAttribute('name', 'rating');
					rating_input.setAttribute('value', rating_val);
					form.appendChild(rating_input);

					var rating_content = document.getElementById('review_content').value;
					var review_content_input = document.createElement('input');
					review_content_input.setAttribute('type', 'hidden');
					review_content_input.setAttribute('name', 'content');
					review_content_input.setAttribute('value', rating_content);
					form.appendChild(review_content_input);

					document.body.appendChild(form);
					form.submit();
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
				<div class='write_wrapper'>
					<div class='write_header'>
						Write reviews:
					</div>
					<div class='write_rating'>
						Rating: 
						<select name='rating' id='review_rating'>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
						</select>
					</div>
					<div class='writing_content'>
						<textarea rows='4' cols='50' name='content' id='review_content'>
						</textarea>
					</div>
					<div class='writing_btn' id='review_write_btn'>
						Write
					</div>
				</div>
			</div>
		</div>
	</body>
</html>