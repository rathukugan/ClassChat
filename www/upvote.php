<?php
    /*connect to database */
    include("sql.php");
    if($_POST['id'])
    {
        $id=mysql_escape_String($_POST['id']);
        // Vote update  
        mysql_query("update questions set rank=rank+1 where id='$id'");
        // Getting latest vote results
        
    }
?>