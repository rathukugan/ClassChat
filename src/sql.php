<?php

/*connect to database */
    $user_name = "root";
    $pass_word = "root";
    $database = "users";
    $server = "localhost";
    
    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db($database, $db_handle);
?>