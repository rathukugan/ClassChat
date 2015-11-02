<?php
    session_start();
    //Initialize error message.
    $errorMessage = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $room = $_POST['room'];

        if (!empty($room)) {
            $room = htmlspecialchars($room);
            /*connect to database */
            include("sql.php");

            $SQL = "SELECT invite, code FROM classes WHERE invite = '$room'";
            $result1 = mysql_query($SQL);
            $find_room = mysql_num_rows($result1);

            if ($find_room > 0) {
                //get lecture info
                $row = mysql_fetch_array($result1, MYSQL_ASSOC);
                $course_code= $row['code'];

                $currentemail = $_SESSION['email'];

                //insert into students table
                $SQL2 = "INSERT INTO students (email, code) VALUES ('$currentemail', '$course_code')";
                $result2 = mysql_query($SQL2);
                mysql_close($db_handle);

                header ("Location: profile.php");
            }
            else {
                $errorMessage = "Invalid room code!";
            }
    }
}
?>

<?php include("assets/templates/header.php"); ?>
<div class="row">
  <div class="col-md-offset-4 col-md-4" style="margin-top:50px; padding-top:100px">
  <h1>Enter room code:</h1>
    <h3 class="title text-center"><?php print $errorMessage;?> </h3>
      <?php //redirect from create
      if (isset($_GET['r'])){
        echo '<form action="room.php?r=1" method="post" class="intro text-center">';
      } else {
        echo '<form action="room.php" method="post" class="intro text-center">';
      }
      ?>
        <div class="form-group">
            <input style="width:300px;"  class="form-control" type="text" name="room" placeholder="Room Code" class="inputs" required><br>
            <span class="help-block"></span>
        </div>
        <button style="width:300px;" type="submit" class="btn btn-theme btn-block">Join</button>
    </form>
  </div>
</div>
<?php include("assets/templates/footer.php"); ?>