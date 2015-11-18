<table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">  
<?php
session_start();
include("sql.php");

$lec_id=$_POST['id'];
    
$comm = mysql_query("SELECT id, question, creator, postTime from questions where lecture='$lec_id' order by postTime desc");
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
exit();
?>