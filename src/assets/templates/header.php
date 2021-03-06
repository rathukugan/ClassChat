<?php 
session_start(); 
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.ico">

    <title>ClassChat</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

    <!--Date picker -->
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/redmond/jquery-ui.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/datepicker/css/ui.daterangepicker.css" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/js/date.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/js/daterangepicker.jQuery.js"></script>
    <script type="text/javascript">
      $(function(){
          $('#rangeA').daterangepicker();
          $('#rangeBa, #rangeBb').daterangepicker();
          $('#rangeC').daterangepicker({arrows: true});
          $('#rangeD').daterangepicker();
          $('#rangeE').daterangepicker({constrainDates: true});
       });
    </script>
  </head>

  <body>
      <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ClassChat</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li <?=echoActiveClassIfRequestMatches("index")?>><a href="index.php">HOME</a></li>
            <?php                        
            //Professor nav buttons
              if (isset($_SESSION['login']) AND $_SESSION['type'] == "Professor"){
                  echo '<li class="nav-item"><a href="#">WELCOME PROFESSOR</a></li>';
                  echo '<li class="nav-item"><a href="profile.php">MY CLASSES</a></li>';
                  echo '<li class="nav-item"><a href="logout.php">LOGOUT</a></li>';
                  echo '<li class="nav-item"><a href="settings.php">SETTINGS</a></li>';
              //Student nav buttons
              } elseif (isset($_SESSION['login']) AND $_SESSION['type'] == "Student"){
                  echo '<li class="nav-item"><a href="#">WELCOME STUDENT</a></li>';
                  echo '<li class="nav-item"><a href="profile.php">MY CLASSES</a></li>';
                  echo '<li class="nav-item"><a href="logout.php">LOGOUT</a></li>';
                  echo '<li class="nav-item"><a href="settings.php">SETTINGS</a></li>';
              } //Not logged in.
              else{
                  echo '<li class="nav-item"><a href="login.php">Login</a></li>';
                  echo '<li class="nav-item"><a href="register.php">Register</a></li>';             
              }
              ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="content" style="margin-top:50px">