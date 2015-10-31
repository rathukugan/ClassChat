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

//Initialize error message.
$errorMessage = "";
/*connect to database */
$user_name = "root";
$pass_word = "csc309";
$database = "startit";
$server = "104.236.231.174:3306";

$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);

/*if page is accessed after attempt */
if (isset($_GET['d'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = $_POST['desc'];
    $email = $_SESSION['email'];
    $id = $_GET['id'];
    $tags = explode(" ", $_POST['tags']);

           
    /* strip of any sketchy characters */
    $title = htmlspecialchars($title);
    $desc = htmlspecialchars($desc);
    $email = htmlspecialchars($email);
    $category = htmlspecialchars($category);

    if ($db_found) {
        $title = quote_smart($title, $db_handle);
        $desc = quote_smart($desc, $db_handle);
        $category = quote_smart($category, $db_handle);
        
        /*check if project exists */
        $SQL = "SELECT * FROM projects WHERE title = '$title''";
        $result = mysql_query($SQL);
        $num_rows = mysql_num_rows($result);

        if ($num_rows > 0) {
            $errorMessage = "Idea name already taken";
        }
        else {
            mysql_query("update projects set title=$title where pID='$id'");
            mysql_query("update projects set description=$desc where pID='$id'");
            mysql_query("update projects set category=$category where pID='$id'");


            $errorMessage= "Changes Saved!";
            //store tags
            foreach ($tags as $tag) {
                $tag = htmlspecialchars($tag);
                $tag = quote_smart($tag, $db_handle);
                mysql_query("INSERT INTO tags (tag, pID) VALUES ($tag, $id)");
                echo $tag;
            }
            mysql_close($db_handle);
            
        }
    }
    else {
        $errorMessage = "Database Not Found";
    }   
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET['id'];
    $SQL = "SELECT * FROM projects WHERE pID = $id";
    $result = mysql_query($SQL);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);

    //get project info
    $title = $row['title'];
    $id = $row['pID'];
    $desc = $row['description'];
    $category = $row['category'];
}
?>
<?php include("assets/templates/header.php"); ?>
    <div class="container well" style="margin-top:130px">
        <div class="row">
            <h2 class="title text-center"> Edit your idea!</h2>
            <h3 class="title text-center"><?=$errorMessage?> </h3>
            <br>
            <form action="edit.php?id=<?=$id?>&d=1" method="post" role="form">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                    <div class="form-group">
                        <label for="InputName">Change your Idea's name!</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="title" id="title" placeholder="i.e. Pebble"            required value="<?=$title?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputCategory">Choose a NEW category for your IDEA!</label>
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
                        <label for="InputMessage">Change your idea's descirption!</label>
                        <div class="input-group">
                            <textarea name="desc" id="desc" class="form-control" rows="5" required placeholder="i.e. An amazing smartwatch with an LCD display..."><?=$desc?></textarea>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputMessage">Add more tags!</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tags" id="tags" placeholder="i.e. health movies fashion">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                </div>
            </form>
        </div>
    </div>
<?php include("assets/templates/footer.php"); ?>