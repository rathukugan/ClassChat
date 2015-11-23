<table class="table table-striped" id="questions_table" style="table-layout:fixed; word-wrap: break-word;
    overflow-wrap: break-word; width: 800px; max-width:800px; display: block; margin-left:auto; margin-right: auto">    
                    <tr>
                        <th width="200"></th>
                        <th width="400">Question</th>
                        <th width="100">Date</th>
                        <th width="100">Rank</th>
                    </tr>
<?php
session_start();
include("sql.php");

$lec_id=$_POST['id'];
    
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
exit();
?>