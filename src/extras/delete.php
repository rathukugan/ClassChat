<?php
$id = $_GET['id'];
 /*connect to database */
$user_name = "root";
$pass_word = "csc309";
$database = "startit";
$server = "104.236.231.174:3306";;

$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);
mysql_query("DELETE FROM projects WHERE pID='$id'");
mysql_query("DELETE FROM tags WHERE pID='$id'");

header ("Location: browse.php");
?>