<?php
session_start();
include("sql.php");
if(isset($_POST['user_comm']))
{
  $question=mysql_real_escape_string($_POST['user_comm']);
  $name=mysql_real_escape_string($_SESSION['email']);
  $lec_id=mysql_real_escape_string($_POST['id']);
  $insert=mysql_query("insert into questions (question, creator, lecture) VALUES ('$question','$name','$lec_id')");
  
  $id=mysql_insert_id($insert);
  $select=mysql_query("SELECT creator, question, postTime, rank from questions where creator='$name' and question='$question' and lecture='$lec_id'");
  
  if($row=mysql_fetch_array($select))
  {
	  $name=$row['creator'];
	  $question=$row['question'];
	  $time=$row['postTime'];
    $rank = $row['rank'];   
  ?>
<tr class="info">
    <td width="70">
    <?php
        if($_SESSION['type'] == 'Professor') echo $name;
        else if($_SESSION['email'] == $name) echo "Resolve";
    ?></td>
    <td width="500" id="student_question"><?php echo $question;?></td>
    <td width="100">
        <?php $timestamp = strtotime($time);
              echo date("g:s A", $timestamp);
        ?>
    </td>
    <td width="80">
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
exit;
}


?>