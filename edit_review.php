<?php
	if(!isset($_COOKIE['user_no'])){
		// Redirect to login
		header("location: login.php");
	}
	
include_once('config.php');

$review_no = $_POST['review_no'];
$user_no = $_COOKIE['user_no'];

$sql = "SELECT * FROM `review` WHERE `review_no`=".$review_no;
$result = mysql_query($sql);
$rows = mysql_fetch_assoc($result);
$showtime_id = $rows['showTime_id'];
$rating = $rows['rating'];
$content = $rows['content'];

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
				var r = document.getElementById('review_rating');
				r.value = <?php echo $rating; ?>;

				$("#review_edit_btn").click(function(){
					var method = 'post';
					var form = document.createElement('form');
					form.setAttribute('method', method);
					form.setAttribute('action', 'review_edit.php');

					var review_no = document.createElement('input');
					review_no.setAttribute('type', 'hidden');
					review_no.setAttribute('name', 'review_no');
					review_no.setAttribute('value', <?php echo $review_no; ?>);
					form.appendChild(review_no);

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
				$("#review_delete_btn").click(function(){
					var yes_no = confirm("Delete this review?");
					if(yes_no == true){
						var method = 'post';
						var form = document.createElement('form');
						form.setAttribute('method', method);
						form.setAttribute('action', 'review_delete.php');

						var review_no = document.createElement('input');
						review_no.setAttribute('type', 'hidden');
						review_no.setAttribute('name', 'review_no');
						review_no.setAttribute('value', <?php echo $review_no; ?>);
						form.appendChild(review_no);

						document.body.appendChild(form);
						form.submit();
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
							<?php
								echo $content;
							?>
						</textarea>
					</div>
					<div class='review_btns'>
						<div class='writing_btn' id='review_edit_btn'>
							Edit
						</div>
						<div class='writing_btn' id='review_delete_btn'>
							Delete
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>