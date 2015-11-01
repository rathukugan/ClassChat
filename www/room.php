<?php
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

                header ("Location: index.php");
            }
            else {
                $errorMessage = "Invalid room code!";
            }
    }
}
?>

<?php include("assets/templates/header.php"); ?>
<div id="login-overlay" class="modal-dialog" style="margin-top:100px">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Enter a room code</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                            <h3 class="title text-center"><?PHP print $errorMessage;?> </h3>
                            <?php //redirect from create
                            if (isset($_GET['r'])){
                              echo '<form action="room.php?r=1" method="post" class="intro text-center">';
                            } else {
                              echo '<form action="room.php" method="post" class="intro text-center">';
                            }
                            ?>
                              <div class="form-group">
                                  <input  class="form-control" type="text" name="room" placeholder="Room Code" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit" class="btn btn-theme btn-block">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php include("assets/templates/footer.php"); ?>