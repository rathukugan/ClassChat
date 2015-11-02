<?php 

//This variable needs to be declared outside of the if block so that it is not undefined when people initially load the login page.
$errorMessage = "";
/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    /* strip of any sketchy characters */
    $email = htmlspecialchars($email);
    $pass = htmlspecialchars($pass);
    
    /*connect to database */
    include("sql.php");
    
    /* if dabatase connected */
    if ($db_found) {
        
        /* build sql query */
        $SQL = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
        $result = mysql_query($SQL);
        
        /* if query returned */
        if ($result) {
            $num_rows = mysql_num_rows($result);
            /* if there is at least one row, user exists */
            if ($num_rows > 0) {
                $errorMessage= "logged on ";
                /* create session */
                session_start();
                $row = mysql_fetch_array($result, MYSQL_ASSOC);
                $_SESSION['login'] = "1";
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                $_SESSION['type'] = $row['type'];
                //$_SESSION['admin'] = $row['admin'];

                if (isset($_GET['r'])){
                  header ("Location: create.php");
                } else {
                  header ("Location: index.php");
                }
                
            }
            else {
                $errorMessage= "Incorrect email or password!";               
            }
        }
        else {
            $errorMessage = "No sql result";
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
              <h4 class="modal-title" id="myModalLabel">Login to CommunityFund</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <h3 class="title text-center"><?PHP print $errorMessage;?> </h3>
                            <?php //redirect from create
                            if (isset($_GET['r'])){
                              echo '<form action="login.php?r=1" method="post" class="intro text-center">';
                            } else {
                              echo '<form action="login.php" method="post" class="intro text-center">';
                            }
                            ?>
                              <div class="form-group">
                                  <label for="username" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="" required title="Please enter your email" placeholder="example@gmail.com">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="pass" value="" required title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit" class="btn btn-success btn-block">Login</button>
                              <a href="contact.php" class="btn btn-default btn-block">Can't Login</a>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <p class="lead">Register</p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="fa fa-check text-success"></span> Join/Create Classes</li>
                          <li><span class="fa fa-check text-success"></span> Ask questions live!</li>
                          <li><span class="fa fa-check text-success"></span> Review past questions.</li>
                          <li><span class="fa fa-check text-success"></span> Takes only 2 minutes</li>
                      </ul>
                        <?php //redirect from create
                          if (isset($_GET['r'])){
                            echo '<p><a href="register.php?r=1" class="btn btn-info btn-block">Register now!</a></p>';
                          } else {
                            echo '<p><a href="register.php" class="btn btn-info btn-block">Register now!</a></p>';
                          }
                        ?>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include("assets/templates/footer.html"); ?>