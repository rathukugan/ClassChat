<?php
//Initialize error message.
$errorMessage = "";
/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $pass = trim($_POST['pass']);
	 $pass2 = trim($_POST['pass2']);
   $category = trim($_POST['category']);
    
    //make sure all fields are set
    if (!empty($email) && !empty($pass) && !empty($name) && !empty($pass2) && !empty($category)){
        
    /* strip of any sketchy characters */
    $email = htmlspecialchars($email);
    $name = htmlspecialchars($name);
    $pass = htmlspecialchars($pass);
	$pass2 = htmlspecialchars($pass2);
    $type = htmlspecialchars($category);
    /*connect to database */
    include("sql.php");
    if ($db_found) {
        
        /*check if user exists */  
        $SQL = "SELECT * FROM users WHERE email = '$email'";
        $result = mysql_query($SQL);
        $num_rows = mysql_num_rows($result);

        if ($num_rows > 0) {
            $errorMessage = "Username already taken!";
        }
		
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errorMessage = "Please make sure to provide a valid e-mail address!";
		}
		
		else if ($pass != $pass2) {
			$errorMessage = "Please make sure that your passwords match!";
		}
        else {

            $SQL = "INSERT INTO users (email, name, password, type) VALUES ('$email', '$name', '$pass', '$type')";
            $errorMessage= "Email: ". $email . "Name: " . $name;
            $result = mysql_query($SQL);
            mysql_close($db_handle);
                
            //open sessions
            session_start();
            $_SESSION['login'] = "1";
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $type;
            if (isset($_GET['r'])){
              header ("Location: create.php");
            } else {
              header ("Location: index.php");
            }
    }
    }
    else {
        $errorMessage = "Database Not Found";
    }
}
}
?>
<?php include("assets/templates/header.php"); ?>
<br>
<br>
    <div id="login-overlay" class="modal-dialog" style="margin-top:100px">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Register</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <h3 class="title text-center"><?PHP print $errorMessage;?> </h3>
                            <?php //redirect from create
                            if (isset($_GET['r'])){
                              echo '<form action="register.php?r=1" method="post" class="intro text-center">';
                            } else {
                              echo '<form action="register.php" method="post" class="intro text-center">';
                            }
                            ?>
                              <div class="form-group">
                                  <label for="username" class="control-label">Name</label>
                                  <input  class="form-control" type="text" name="name" placeholder="Name" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="username" class="control-label">Email</label>
                                  <input  class="form-control" type="text" name="email" placeholder="Email" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input  class="form-control" type="password" name="pass" placeholder="Password" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Re-enter Password</label>
                                  <input class="form-control" type="password" name="pass2" placeholder="Re-enter Password" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                              <label for="InputCategory">Professor or Student</label>
                              <div class="input-group">
                                  <select name="category" class="form-control" required>
                                      <option>Student</option>
                                      <option>Professor</option>
                                  </select>
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-theme btn-block">Register</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include("assets/templates/footer.php"); ?>