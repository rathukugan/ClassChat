<?php
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

session_start();
if ($_SESSION['login'] != "1"){
    header ("Location: login.php");
}

//Initialize error message.
$errorMessage = "";

/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = $_POST['desc'];
    $email = $_SESSION['email'];
    $tags = explode(" ", $_POST['tags']);

           
    /* strip of any sketchy characters */
    $title = htmlspecialchars($title);
    $desc = htmlspecialchars($desc);
    $email = htmlspecialchars($email);
    $category = htmlspecialchars($category);

    /*connect to database */
    $user_name = "root";
    $pass_word = "csc309";
    $database = "startit";
    $server = "104.236.231.174:3306";

    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db($database, $db_handle);

    if ($db_found) {
        $title = quote_smart($title, $db_handle);
        $desc = quote_smart($desc, $db_handle);
        $category = quote_smart($category, $db_handle);
        
        /*check if project exists */
        $SQL = "SELECT * FROM projects WHERE title = $title";
        $result = mysql_query($SQL);
        $num_rows = mysql_num_rows($result);

        if ($num_rows > 0) {
            $errorMessage = "Idea name already taken";
        }
        else {
            $SQL = "INSERT INTO projects (title, description, creator, category) VALUES ($title, $desc, 
                $email, $category)";
            
            //execute
            $result = mysql_query($SQL);

            //get pid for tag storing
            $SQL2 = "SELECT * FROM projects WHERE title = $title";
            $result = mysql_query($SQL2);
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            $id = $row['pID'];
            $errorMessage= "Created!";
            //store tags
            foreach ($tags as $tag) {
                $tag = htmlspecialchars($tag);
                $tag = quote_smart($tag, $db_handle);
                mysql_query("INSERT INTO tags (tag, pID) VALUES ($tag, $id)");
            }
            
            mysql_close($db_handle);

            //store current project
            session_start();
            $_SESSION['idea'] = "$title";

            //
            header ("Location: idea.php?id=" . $id);
            
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
            <h2 class="title text-center"> Tell us about your Idea!</h2>
            <h3 class="title text-center"><?=$errorMessage?> </h3>
            <br>
            <form action="create.php" method="post" role="form">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                    <div class="form-group">
                        <label for="InputName">Idea Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="title" id="title" placeholder="i.e. Pebble"            required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputCategory">Choose a category</label>
                        <div class="input-group">
                            <select name="category" class="form-control" required>
                                <option>Health</option>
                                <option>Technology</option>
                                <option>Education</option>
                                <option>Finance</option>
                                <option>Travel</option>
                                <option>Film and Video</option>
                                <option>Design</option>
                                <option>Games</option>
                            </select>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputMessage">Describe your idea!</label>
                        <div class="input-group">
                            <textarea name="desc" id="desc" class="form-control" rows="5" required placeholder="i.e. An amazing smartwatch with an LCD display..."></textarea>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputMessage">Add some keywords or tags that associate with your idea! Each tag should be seperated by a space!</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tags" id="tags" placeholder="i.e. health movies fashion" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                </div>
            </form>
        </div>
    </div>
<?php include("assets/templates/footer.php"); ?>