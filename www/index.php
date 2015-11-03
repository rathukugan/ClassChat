    <?php include("assets/templates/header.php"); ?>
    <!-- Main -->
    <div id="headerwrap">
        <div class="container">
            <div class="row">
                
                <div class="row">

                    <?php 
                    if (isset($_SESSION['login']) AND $_SESSION['type'] == "Professor"){
                        ?>
                        <div class="col-sm-12">
                            <br/><br/><br/><a href="create.php" class="btn btn-theme btn-lg">New Class</a>
                            <a href="#" class="btn btn-theme btn-lg">New Lecture Session</a>
                        </div>
                        <?
                    } elseif (isset($_SESSION['login']) AND $_SESSION['type'] == "Student"){
                        ?>
                        <div class="col-sm-12">
                            <br/><br/><br/><a href="room.php" class="btn btn-theme btn-lg">Join a class</a>
                             <a href="profile.php" class="btn btn-theme btn-lg">View Classes</a>
                        </div>
                        <?
                    }
                    else {
                        $create_permission = "login.php?r=1";
                    }
                ?>
                </div>
            </div><!-- /row -->
        </div> <!-- /container -->
    </div><!-- /headerwrap -->
    <!-- Info -->

     <div id="service">
        <div class="container">
            <div class="row centered">
                <div class="col-md-4">
                    <i class="fa fa-pencil-square-o"></i>
                    <h4>Ask questions live.</h4>
                    <p>Ask the professor questions live during lecture.</p>
                    
                </div>
                <div class="col-md-4">
                    <i class="fa fa-list"></i>
                    <h4>Join classes.</h4>
                    <p>Join a class using a key provided by your professor and never miss an important question.</p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-puzzle-piece"></i>
                    <h4>Easy to use for professors.</h4>
                    <p>Simply create a class and start a new session, students will be notified when your class is live!</p>
                </div>                      
            </div>
            <div class="row centered">
                <div class="col-md-4">
                    <p><a href="profile.php" class="btn btn-theme">Ask a question!</a></p>
                </div>
                <div class="col-md-4">
                    <p><a href="room.php" class="btn btn-theme">Join a class!</a></p>
                </div>
                <div class="col-md-4">
                    <p><a href="#" class="btn btn-theme">Start a class!</a></p>
                </div>
            </div>
        </div><!--/container -->
     </div><!--/service -->
    
<?php include("assets/templates/footer.php"); ?>
    
