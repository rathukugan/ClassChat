<table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">  
<?php
session_start();
include("sql.php");

$lec_id=$_POST['id'];
    
$comm = mysql_query("SELECT id, question, creator, postTime, rank from questions where lecture='$lec_id' order by rank desc");
while($row=mysql_fetch_array($comm))
{
  $name=$row['creator'];
  $question=$row['question'];
  $time=$row['postTime'];   
  $id=$row['id']; 
  $rank = $row['rank'];         
?>

<tr>
    <td><a href="#"></a></td>
    <td><?php echo $question;?></td>
    <td>Posted By:<?php echo $name;?></td>
    <td><?=$time?></td>
    <td><?=$id?></td>
    <td>
    <div class="item" data-postid="<?php echo $row['id'] ?>" data-score="<?php echo $row['rank'] ?>">
        <div class="vote-span"><!-- voting-->
            <div class="vote" data-action="up" title="Vote up">
              <i class="icon-chevron-up"></i>
            </div><!--vote up-->
            <div class="vote-score"><?php echo $rank ?></div>
            
        </div>
    </div>
	</td>
</tr>

<?php
}
exit();
?>