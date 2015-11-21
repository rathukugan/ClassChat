<?php
session_start();
include("sql.php");
if(isset($_POST['user_comm']))
{
  $question=$_POST['user_comm'];
  $name=$_SESSION['email'];
  $lec_id=$_POST['id'];
  $insert=mysql_query("insert into questions (question, creator, lecture) VALUES ('$question','$name','$lec_id')");
  
  $id=mysql_insert_id($insert);
  $select=mysql_query("SELECT creator, question, postTime from questions where creator='$name' and question='$question' and lecture='$lec_id'");
  
  if($row=mysql_fetch_array($select))
  {
	  $name=$row['creator'];
	  $question=$row['question'];
	  $time=$row['postTime'];
  ?>
  <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">
  <tr>
    <td><a href="#"></a></td>
    <td><?php echo $question;?></td>
    <td>Posted By:<?php echo $name;?></td>
    <td><?=$time?></td>
  </tr>
  <?php
  }
exit;
}


?>