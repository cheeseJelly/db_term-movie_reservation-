<?php
include_once('config.php');

$title = $_POST['movie_title'];
$year = $_POST['movie_year'];
$playMinutes = $_POST['movie_playMinutes'];
$genre_text = $_POST['movie_genre'];
$director = $_POST['movie_director'];
$actor_text = $_POST['movie_actor'];
$image_url = "./images/None.jpg";

$genres = explode(",", $genre_text);
$actors = explode(",", $actor_text);



$success = true;

$result = mysql_query("SET AUTOCOMMIT=0;");
$result = mysql_query("START TRANSACTION;");

// Add movie
$m_sql = "INSERT INTO `movie` (`title`, `year`, `image_url`, `playMinutes`) VALUES ( '".$title."', '".$year."', '".$image_url."', ".$playMinutes.")";
$m_r = mysql_query($m_sql);
if(!$m_r){
	//	mysql_query("rollback;");
	echo $m_sql;
	echo "<br />ROLLBACK here";
	$success = false;
} 

// get movie id
$m_id_sql = "SELECT LAST_INSERT_ID();";
$m_id_result = mysql_query($m_id_sql);
if(!$m_id_result){
	echo $m_id_sql;
	exit;
}else{
	$movie_array = mysql_fetch_array($m_id_result);
	$new_movie_no = $movie_array[0];
}

// check movie_director
$d_find_sql = "SELECT * FROM `people` WHERE `name` = '".$director."'";
$d_find_result = mysql_query($d_find_sql);
$d_find_num_rows = mysql_num_rows($d_find_result);
if($d_find_num_rows == 0){
	// No director -> add people
	$add_people_sql = "INSERT INTO `people` (`name`) VALUES ('".$director."')";
	$add_people_result = mysql_query($add_people_sql);

	if(!$add_people_result){
		//	mysql_query("rollback;");
		echo $add_people_sql;
		echo "<br />ROLLBACK here";
		$success = false;
	}
	$d_id_sql = "SELECT LAST_INSERT_ID();";
	$d_id_result = mysql_query($d_id_sql);
	if(!$d_id_result){
		echo $d_id_sql;
		exit;
	}else{
		$people_array = mysql_fetch_array($d_id_result);
		$director_id = $people_array[0];
	}

}else{
	$director_row = mysql_fetch_assoc($d_find_result);
	$director_id = $director_row['people_id'];
}
//	echo $director_id;
// add movie_director
$m_d_sql = "INSERT INTO `movie_director` (`movie_no`, `people_id`) VALUES (".$new_movie_no.", ".$director_id.")";
$m_d_r = mysql_query($m_d_sql);
if(!$m_d_r){
	//	mysql_query("rollback;");
	echo $m_d_sql;
	echo "<br />ROLLBACK here";
	$success = false;
} 

// check movie_actors
foreach($actors as $actor){
	//echo $actor;
	$a_find_sql = "SELECT * FROM `people` WHERE `name` = '".$actor."'";
	$a_find_result = mysql_query($a_find_sql);
	$a_find_num_rows = mysql_num_rows($a_find_result);
	if($a_find_num_rows == 0){
		// No actor -> add people
		$add_people_sql = "INSERT INTO `people` (`name`) VALUES ('".$actor."')";
		$add_people_result = mysql_query($add_people_sql);

		if(!$add_people_result){
			//	mysql_query("rollback;");
			echo $add_people_sql;
			echo "<br />ROLLBACK here";
			$success = false;
		}
		$a_id_sql = "SELECT LAST_INSERT_ID();";
		$a_id_result = mysql_query($a_id_sql);
		if(!$a_id_result){
			echo $a_id_sql;
			exit;
		}else{
			$people_array = mysql_fetch_array($a_id_result);
			$actor_id = $people_array[0];
		}

	}else{
		$actor_row = mysql_fetch_assoc($a_find_result);
		$actor_id = $actor_row['people_id'];
	}
	$a_d_sql = "INSERT INTO `movie_actor` (`movie_no`, `people_id`) VALUES (".$new_movie_no.", ".$actor_id.")";
	$a_d_r = mysql_query($a_d_sql);
	if(!$a_d_r){
		//	mysql_query("rollback;");
		echo $a_d_sql;
		echo "<br />ROLLBACK here";
		$success = false;
	} 
}

// check movie_genres

foreach($genres as $genre){
	//echo $genre;
	$g_find_sql = "SELECT * FROM `genre` WHERE `genre_type` = '".$genre."'";
	$g_find_result = mysql_query($g_find_sql);
	$g_find_num_rows = mysql_num_rows($g_find_result);
	if($g_find_num_rows == 0){
		// No genre -> add people
		$add_genre_sql = "INSERT INTO `genre` (`genre_type`) VALUES ('".$genre."')";
		$add_genre_result = mysql_query($add_genre_sql);

		if(!$add_genre_result){
			//	mysql_query("rollback;");
			echo $add_genre_sql;
			echo "<br />ROLLBACK here";
			$success = false;
		}
		$g_id_sql = "SELECT LAST_INSERT_ID();";
		$g_id_result = mysql_query($g_id_sql);
		if(!$g_id_result){
			echo $g_id_sql;
			exit;
		}else{
			$genre_array = mysql_fetch_array($g_id_result);
			$genre_id = $genre_array[0];
		}

	}else{
		$actor_row = mysql_fetch_assoc($g_find_result);
		$genre_id = $actor_row['genre_id'];
	}
	$a_g_sql = "INSERT INTO `movie_genre` (`movie_no`, `genre_id`) VALUES (".$new_movie_no.", ".$genre_id.")";
	$a_g_r = mysql_query($a_g_sql);
	if(!$a_g_r){
		//	mysql_query("rollback;");
		echo $a_g_sql;
		echo "<br />ROLLBACK here";
		$success = false;
	} 
}

if(!$success){
	mysql_query("ROLLBACK;");
	echo "Rollback!";
}else{
	mysql_query("COMMIT");
	echo "DONE!";
	echo "<script>alert('Reservation is done!');</script>";
	header("location: manage.php");
}



?>