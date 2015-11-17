<?php
    /*connect to database */
    include("sql.php");
    $lec_id = $_GET['id'];
        //find lecture by id from GET
    $find_lecture = "SELECT class, topic, num FROM lectures WHERE id = '$lec_id'";

    //get lecture info
    $row = mysql_fetch_array(mysql_query($find_lecture), MYSQL_ASSOC);
    $lec_num = $row['num'];
    $course = $row['class'];
    $topic = $row['topic'];

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
        document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
        document.getElementById("comment").value="";
  
      }
    });
  }
  
  return false;
}
</script>
<?php include("assets/templates/header.php"); ?>
<div class="container well" style="margin-top:130px">

    <div class="row">
        <h2 class="title text-center">Questions for professor <?=$name; ?></h2>
        <?php if($_SESSION['type'] == "Student") : ?>
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
                    <div id="all_comments">
                    <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">
                    <?php
                  
                    $comm = mysql_query("SELECT question, creator, postTime from questions where lecture='$lec_id' order by postTime desc");
                    while($row=mysql_fetch_array($comm))
                    {
                      $name=$row['creator'];
                      $question=$row['question'];
                      $time=$row['postTime'];
                    ?>
                    
                    <tr>
                        <td><a href="#"></a></td>
                        <td><?php echo $question;?></td>
                        <td>Posted By:<?php echo $name;?></td>
                        <td><?=$time?></td>
                    </tr>
                  
                    <?php
                    }
                    ?>
                    </table>
                  </div>
                
        <?php endif; ?>
        <br>
    </div>
        
</div>

    

<?php include("assets/templates/footer.php"); ?>