<?php
    session_start();
    /*connect to database */
    include("sql.php");
    $lec_id = $_GET['id'];
        //find lecture by id from GET
    $find_lecture = "SELECT class, topic, num, flag, voters, satisfied, unsatisfied FROM lectures WHERE id = '$lec_id'";

    //get lecture info
    $row = mysql_fetch_array(mysql_query($find_lecture), MYSQL_ASSOC);
    $lec_num = $row['num'];
    $course = $row['class'];
    $topic = $row['topic'];
    $flag = $row['flag'];
    $voters = $row['voters'];

    $satisfied = $row['satisfied'];
    $unsatisfied = $row['unsatisfied'];

    $voters_array = explode(",", $voters);

    //get course info
    $find_course = "SELECT creator FROM classes WHERE code = '$course'";

    //grab course code
    $row2 = mysql_fetch_array(mysql_query($find_course), MYSQL_ASSOC);
    $creator_email = $row2['creator'];

    //grab proff name
    $find_proff = "SELECT name FROM users WHERE email = '$creator_email'";

    //get proff name
    $row3 = mysql_fetch_array(mysql_query($find_proff), MYSQL_ASSOC);
    $name = $row3['name'];
    
    /* Professor ends the lecture session */
    if (!empty($_POST['end_lecture'])){
        $flag = "ended";

        if ($db_found) {
            /* Update the 'flag' value of the lecture session to 'ended' */
            $SQL = "UPDATE lectures SET flag='$flag' WHERE id = '$lec_id'";
            $result = mysql_query($SQL);
        }
    }

    /* Students vote in the 'satisfied/unsatisfied' poll */
    if(!empty($_POST['vote']) && !(in_array($_SESSION['email'], $voters_array)) ){
        $poll = $_POST['poll'];

        if ($db_found) {
            /* Update upvote/downvote value in database */
            if($poll == "satisfied"){
                $satisfied += 1;
                $SQL = "UPDATE lectures SET satisfied=satisfied+1 WHERE id = '$lec_id'";

            } else{
                $unsatisfied += 1;
                $SQL = "UPDATE lectures SET unsatisfied=unsatisfied+1 WHERE id = '$lec_id'";
            }
            $result = mysql_query($SQL);

            /* Update csv of students(by session value) that already voted */
            if($voters == "empty"){
                $voters =  $_SESSION['email'];
            } else{
                $voters = $voters . ',' . $_SESSION['email'];
            }

            $SQL = "UPDATE lectures SET voters='$voters' WHERE id ='$lec_id'";
            $result = mysql_query($SQL);
            
        }
    }
    
    
?>
<script type="text/javascript">
function post()
{
  var comment = document.getElementById("comment").value;
  if(comment)
  {
    $.ajax
    ({
      type: 'post',
      url: 'ask_question.php',
      data: 
      {
         user_comm:comment,
         'id': <?=$lec_id?>
      },
      success: function (response) 
      {
        document.getElementById("questions_table").innerHTML=document.getElementById("all_comments").innerHTML + response;
        document.getElementById("comment").value="";
  
      }
    });
  }
  
  return false;
}
</script>
<script type="text/javascript" src="assets/js/notifications.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
  //Set up notification permissions
  notificationSetUp();

  // ajax setup
  $.ajaxSetup({
    url: 'upvote.php',
    type: 'POST',
    cache: 'false'
  });

  // any voting button (up/down) clicked event
  $('.vote').click(function(){
    var self = $(this); // cache $this
    var action = self.data('action'); // grab action data up/down 
    var parent = self.parent().parent(); // grab grand parent .item
    var postid = parent.data('postid'); // grab post id from data-postid
    var score = parent.data('score'); // grab score form data-score

    // only works where is no disabled class
    if (!parent.hasClass('.disabled')) {
      // vote up action
      if (action == 'up') {
        // increase vote score and color to orange
        parent.find('.vote-score').html(++score).css({'color':'orange'});
        // change vote up button color to orange
        self.css({'color':'orange'});
        // send ajax request with post id & action
        $.ajax({data: {'id' : postid, 'action' : 'up'}});
      }
      // add disabled class with .item
      parent.addClass('.disabled');
    };
  });
});
</script>


<?php include("assets/templates/header.php"); ?>

<script type="text/javascript" src="assets/js/notifications.js"></script>
<div class="container well" style="margin-top:130px">
<?php
 echo '<input type="hidden" id="logged" value="'.$_SESSION['type'].'">'
?>
    <div class="row">
    <h3 class="title text-center">Professor: <?=$name; ?></h3>
    <h3 class="title text-center">Lecture: <?=$topic; ?></h3>


        <?php 
        if ($_SESSION['type'] == "Professor"){
            // lecture session is 'ongoing'
            if($flag == 'ongoing'){
                ?>
                <form action="" method="post" role="form">
                    <div class="col-md-7 text-center"> 
                        <input type="submit" name="end_lecture" id="end_lecture" value="End Lecture Session" class="btn btn-danger pull-right">
                    </div>
                </form>
                <br><br><br>
                <?php
            // lecture session has 'ended'
            }
        }
        ?>

        <?php 
            
                if($flag == 'ongoing'){
                    if($_SESSION['type'] == "Student"){ 
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                                <form method="post" action="" onsubmit="return post();">
                                <div class="form-group" style="text-align: center">
                                    <input id="comment"style="width: 600px; padding: 5px" type="text" name="question" placeholder="Ask a Question!" class="inputs" required>
                                    
                                <button type="submit" class="btn btn-theme">Send</button>
                                </div>
                                </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
                    <div id="all_comments">
                    <table class="table table-striped" id="questions_table" style="table-layout:fixed; word-wrap: break-word;
    overflow-wrap: break-word; width: 800px; max-width:800px; display: block; margin-left:auto; margin-right: auto">    
                    <tr>
                        <th width="200"></th>
                        <th width="400">Question</th>
                        <th width="100">Date</th>
                        <th width="100">Rank</th>
                    </tr>
                    <?php
                  
                    $comm = mysql_query("SELECT id, question, creator, postTime, rank from questions where lecture='$lec_id' order by id");
                    while($row=mysql_fetch_array($comm))
                    {
                      $name=$row['creator'];
                      $question=$row['question'];
                      $time=$row['postTime'];    
                      $id=$row['id']; 
                      $rank = $row['rank'];      
                    ?>
                    
                    <tr>
                            <td width="200">
                            <?php
                                if($_SESSION['type'] == 'Professor') echo $name;
                                else if($_SESSION['email'] == $name) echo "Resolve";
                            ?></td>
                            <td width="400" id="student_question"><?php echo $question;?></td>
                            <td width="100" >
                                <?php $timestamp = strtotime($time);
                                      echo date("g:s A", $timestamp);
                                ?>
                            </td>
                            <td width="100">
                                <div class="item" data-postid="<?php echo $row['id'] ?>" data-score="<?php echo $row['rank'] ?>">
                                    <div class="vote-span"><!-- voting-->
                                        <div class="vote" data-action="up" title="Vote up">
                                          <span class="vote-score"><?php echo $rank ?></span>  
                                          <?php if ($_SESSION['type'] == "Student"){ ?>
                                            <i class="icon-chevron-up"></i>
                                          <?php } ?>
                                        </div><!--vote up-->
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }

                    ?>
                    </table>
                  </div>    
            <?php   
                } else{
                    $voters_array = explode(",", $voters);
                    if(in_array($_SESSION['email'], $voters_array) || $_SESSION['type'] == 'Professor'){
                        /* User has already voted */
                        ?>
                        <h3 align="center">Lecture satisfaction results:</p>
                        <p align="center">
                            <span style="font-size: 2.5em; color: green" class="glyphicon glyphicon-thumbs-up"></span>
                            <span style="margin-right: 20px; font-size: 1.5em"> <?php echo $satisfied;?> </span>
                            <span style="font-size: 2.5em; color: red" class="glyphicon glyphicon-thumbs-down"></span>
                            <span style="font-size: 1.5em"> <?php echo $unsatisfied;?> </span>
                        </h3>
            <?php
                    } else{
                        if($_SESSION['type'] == 'Student')
                    ?>
                        <!-- Display a poll to students: satisfied vs. unsatisfied -->
                        <div class="col-sm-12">
                            <form action="" method="post" role="form" style="width: 500px; margin: 0 auto; border-style: solid;
                            padding: 20px">
                                <h2>How clear was the lecture?</h2>
                                <div class="radio">
                                    <label><input type="radio" checked="checked" name="poll" value="satisfied">Satisfied</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="poll" value="unsatisfied">Unsatisfied</label>
                                </div>
                                <div style="text-align: center">
                                <input type="submit" name="vote" id="vote" value="Vote" class="btn btn-info">
                                </div>
                            </form>
                        </div>
            <?php
                    }
                    ?>
                    <div style="text-align: center">
                    <a class="btn btn-lg btn-theme" href="questions.php?course=<?=$code?>">View This Lecture's Questions</a>
                    </div>
                    <?php
                }
            
        ?>
        <br>
    </div>
        
</div>

<script type="text/javascript">
window.setInterval(function() {
    // Every 5 seconds send an AJAX request and update the table
    $.ajax({
        url: 'check.php',
        type: 'post',
        data:{'id': <?=$lec_id?>},        
        success: function (result) {
            document.getElementById("all_comments").innerHTML=result;
        }
    });

    //Check if notifications are needed, show them upon need
    if($('#logged').val() == 'Professor') checkNotificaionNeeds();
}, 5000); 
</script>

<?php include("assets/templates/footer.php"); ?>