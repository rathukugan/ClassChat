<?php
    /*connect to database */
    include("sql.php");
    $course_code = $_GET['course'];
    //find lecture by id from GET

    $find_questions = mysql_query("SELECT questions.id, question, answer, creator, topic, num FROM lectures, questions WHERE questions.lecture = lectures.id AND lectures.class = '$course_code'");

    //get lecture info  
?>

<?php include("assets/templates/header.php"); ?>
<div class="container well" style="margin-top:130px">

    <div class="row">
        <h2 class="title text-center">Questions for professor ****</h2>

        <?php 
            if ($_SESSION['type'] == "Professor"){
                ?>
                 <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">                   
                    <?php
                    while($row=mysql_fetch_array(mysql_query($find_questions), MYSQL_ASSOC))
                    {
                        $lec_num = $row['num'];
                        $topic = $row['topic'];
                        $question = $row['question'];
                        $answer = $row['answer'];
                        $creator = $row['creator'];            
                    ?>
                    
                    <tr>
                        <td><a href="#"></a></td>
                        <td><?php echo $question;?></td>
                        <td>Posted By:<?php echo $creator;?></td>
                        <td><?=$lec_num?></td>
                    </tr>
                  
                    <?php
                    }

                    ?>
                </table>
                <?php
            }
        ?>

        <?php 
            if($_SESSION['type'] == "Student"){ 
                ?>
                <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">
                <?php
             
                while($row=mysql_fetch_array($find_questions))
                {
                        $lec_num = $row['num'];
                        $topic = $row['topic'];
                        $question = $row['question'];
                        $answer = $row['answer'];
                        $creator = $row['creator'];           
                    ?>
                    
                    <tr>
                        <td><a href="#"></a></td>
                        <td><?php echo $question;?></td>
                        <td>Posted By:<?php echo $creator;?></td>
                        <td><?=$lec_num?></td>
                    </tr>
                  
                    <?php
                }

                ?>
                </table>
                <?php
            }
        ?>
        <br>
    </div>
        
</div>

<?php include("assets/templates/footer.php"); ?>