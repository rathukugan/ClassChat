<?php 
session_start();
//This variable needs to be declared outside of the if block so that it is not undefined when people initially load the login page.
$errorMessage = "";
/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $passOrig = $_POST['passOrig'];
    $passNew = $_POST['passNew'];
    $passVerify = $_POST['passVerify'];

    $email = $_SESSION['email'];

    
    /* strip of any sketchy characters */
    $passOrig = htmlspecialchars($passOrig);
    $passNew = htmlspecialchars($passNew);
    $passVerify = htmlspecialchars($passVerify);
    
    /*connect to database */
    include("sql.php");
    
    /* if dabatase connected */
    if ($db_found) {

        if ($passNew === $passVerify) {
        
            /* build sql query */
            $SQL = "SELECT * FROM users WHERE email = '$email' AND password = '$passOrig'";
            $result = mysql_query($SQL);
            
            /* if query returned */
            if ($result) { //Passwords match and 
                $num_rows = mysql_num_rows($result);
                /* if there is at least one row, user exists */
                if ($num_rows > 0) {

                    $SQL_Update = "UPDATE users SET password='$passNew' WHERE email = '$email' AND password = '$passOrig'";
                    $update = mysql_query($SQL_Update);

                    //password changed
                    header ("Location: index.php");
                    
                }
                else {
                    $errorMessage= "Incorrect Old Password!";               
                }

            } 
        }
        else {
            $errorMessage= "New password doesnt match!"; 
        }
    }
    else {
        $errorMessage = "SQL error";
    }
}
?>
<?php include("assets/templates/header.php"); ?>
<br>
<br>
<br>
<br>
    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Change Password</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <h3 class="title text-center"><?PHP print $errorMessage;?> </h3>
                            <?php //redirect from create
                            if (isset($_GET['r'])){
                              echo '<form action="settings.php?r=1" method="post" class="intro text-center">';
                            } else {
                              echo '<form action="settings.php" method="post" class="intro text-center">';
                            }
                            ?>
                              <div class="form-group">
                                  <label for="password" class="control-label">Old Password</label>
                                  <input type="password" class="form-control" id="passwordOrig" name="passOrig" value="" required title="Please enter your old password">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">New Password</label>
                                  <input type="password" class="form-control" id="passwordNew" name="passNew" value="" required title="Please enter your new password">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Verify Password</label>
                                  <input type="password" class="form-control" id="passwordVerify" name="passVerify" value="" required title="Please enter your new password">
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include("assets/templates/footer.html"); ?>