<?php
$host = 'localhost';
$user = 'root';
$pw = 'root';
$dbName = 'db_term';

$connect = mysql_connect($host, $user, $pw); 

if(!$connect){
	 die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbName, $connect) or die('could not select db');
?>