<?php

session_start();
if ($_SESSION['login'] != "1"){
    header ("Location: login.php");
}

//Initialize error message.
$errorMessage = "";

/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $topic = trim($_POST['topic']);
    $email = trim($_SESSION['email']);
    $course = $_GET['course'];
           
    /* strip of any sketchy characters */
    $topic = htmlspecialchars($topic);
    $email = htmlspecialchars($email);

    /*connect to database */
    include("sql.php");

    if ($db_found) {
        
        /*check if project exists */
        $SQL = "SELECT * FROM lectures WHERE topic = '$topic' AND class = '$course'";
        $result = mysql_query($SQL);
        $num_rows = mysql_num_rows($result);

        if ($num_rows > 0) {
            $errorMessage = "Lecture topic already exists!";
        }
        else {
            $count_lecturenum = "SELECT count(id) FROM lectures WHERE class = '$course'";        
            $row = mysql_fetch_array(mysql_query($count_lecturenum), MYSQL_ASSOC);
            $num = $row['count(id)'] + 1;
            $SQL = "INSERT INTO lectures (class, topic, num) VALUES ('$course', '$topic', '$num')";
            
            //execute
            $result = mysql_query($SQL);
            
            $find_lec_id = "SELECT id FROM lectures WHERE class = '$course' AND num = '$num'";
            $row = mysql_fetch_array(mysql_query($find_lec_id), MYSQL_ASSOC);
            $lec_id = $row['id'];
            mysql_close($db_handle);

            //go to live lecture section
            header ("Location: live_lec.php?id=" . $lec_id);
            
        }
    }
    else {
        $errorMessage = "Database Not Found";
    }
    
}
?>
<?php include("assets/templates/header.php"); ?>
    <div class="container well" style="margin-top:130px">
        <div class="row">
            <h2 class="title text-center"> Start a new live session</h2>
            <h3 class="title text-center"><?=$errorMessage?> </h3>
            <br>
            <form action="new_lecture.php?course=<?=$_GET['course']?>" method="post" role="form">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                    <div class="form-group">
                        <label for="InputName">Topic</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="topic" id="code" placeholder="i.e. Learning GitHub" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>                                      

                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                </div>
            </form>
        </div>
    </div>
<?php include("assets/templates/footer.php"); ?>