<?php
include_once('config.php');

$movie_no = $_POST['movie_no'];
$title = $_POST['movie_title'];
$year = $_POST['movie_year'];
$playMinutes = $_POST['movie_playMinutes'];
$genre_text = $_POST['movie_genre'];
$director = $_POST['movie_director'];
$actor_text = $_POST['movie_actor'];

$genres = explode(",", $genre_text);
$actors = explode(",", $actor_text);


$success = true;

$result = mysql_query("SET AUTOCOMMIT=0;");
$result = mysql_query("START TRANSACTION;");

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

echo $director_id;

// update movie_director
$md_sql = "SELECT * FROM `movie_director` WHERE `movie_no` = ".$movie_no;
$md_r = mysql_query($md_sql);
$md_row = mysql_fetch_assoc($md_r);
$md_rel_id = $md_row['movie_director_rel_id'];

$md_sql = "UPDATE `movie_director` SET `people_id` = ".$director_id." WHERE `movie_director_rel_id` = ".$md_rel_id;
$md_r = mysql_query($md_sql);
if(!$md_r){
	//	mysql_query("rollback;");
	echo $md_sql;
	echo "<br />ROLLBACK here";
	$success = false;
} 

// check movie_actors
$d_a_sql = "DELETE FROM `movie_actor` WHERE `movie_no` = ".$movie_no;
$d_a_r = mysql_query($d_a_sql);

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

	// add actor again
	$a_d_sql = "INSERT INTO `movie_actor` (`movie_no`, `people_id`) VALUES (".$movie_no.", ".$actor_id.")";
	$a_d_r = mysql_query($a_d_sql);
	if(!$a_d_r){
		//	mysql_query("rollback;");
		echo $a_d_sql;
		echo "<br />ROLLBACK here";
		$success = false;
	} 
}

// check movie_genres
$d_d_sql = "DELETE FROM `movie_genre` WHERE `movie_no` = ".$movie_no;
$d_a_r = mysql_query($d_d_sql);

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
	$a_g_sql = "INSERT INTO `movie_genre` (`movie_no`, `genre_id`) VALUES (".$movie_no.", ".$genre_id.")";
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
	header("location: manage.php");
}



?>