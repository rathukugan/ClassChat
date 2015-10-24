<?php

session_start();
if ($_SESSION['login'] != "1"){
    header ("Location: login.php");
}

//Initialize error message.
$errorMessage = "";

/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $code = trim($_POST['code']);
    $desc = trim($_POST['desc']);
    $email = trim($_SESSION['email']);
           
    /* strip of any sketchy characters */
    $code = htmlspecialchars($code);
    $desc = htmlspecialchars($desc);
    $email = htmlspecialchars($email);

    /*connect to database */
    include("sql.php");

    if ($db_found) {
        
        /*check if project exists */
        $SQL = "SELECT * FROM classes WHERE code = '$code'";
        $result = mysql_query($SQL);
        $num_rows = mysql_num_rows($result);

        if ($num_rows > 0) {
            $errorMessage = "Class already exists!";
        }
        else {
            $invite = uniqid();
            $SQL = "INSERT INTO classes (code, description, creator, invite) VALUES ('$code', '$desc', '$email', '$invite')";
            
            //execute
            $result = mysql_query($SQL);
            
            mysql_close($db_handle);

            //store current project
            session_start();
            $_SESSION['class'] = "$code";

            //go to class page
            header ("Location: class.php?id=" . $id);
            
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
            <h2 class="title text-center"> Create a class!</h2>
            <h3 class="title text-center"><?=$errorMessage?> </h3>
            <br>
            <form action="create.php" method="post" role="form">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                    <div class="form-group">
                        <label for="InputName">Course Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="code" id="code" placeholder="i.e. CSC301" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>                                      
                    
                    <div class="form-group">
                        <label for="InputMessage">Class description</label>
                        <div class="input-group">
                            <textarea name="desc" id="desc" class="form-control" rows="5" required placeholder="i.e. Software Engineering blah blah..."></textarea>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                </div>
            </form>
        </div>
    </div>
<?php include("assets/templates/footer.php"); ?>