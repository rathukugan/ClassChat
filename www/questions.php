<?php
    session_start();
    
    /*connect to database */
    include("sql.php");
    $course_code = $_GET['course'];
    $action = $_GET['action'];
    $q_id = $_GET['id'];
    if($action == 'delete') {
        mysql_query("DELETE FROM questions WHERE id = '$q_id'");        
    }
    else if($action == 'markAnswered') {
        mysql_query("UPDATE questions SET answered = 1 WHERE id = '$q_id'");        
    }
    else if ($action == 'markUnanswered') {
        mysql_query("UPDATE questions SET answered = 0 WHERE id = '$q_id'");        
    }

    
    $qry = "SELECT questions.id, question, answer, creator, topic, num, answered FROM lectures, questions, "; 

    // find the classes that the user is enrolled in
    $email = htmlspecialchars($_SESSION['email']);
    if ($_SESSION['type'] == "Student") {
        $classes = "(SELECT * FROM students WHERE email = '$email') AS classes";
    }
    else {
        $classes = "(SELECT * FROM classes WHERE creator = '$email') AS classes";
    }
    $qry .= $classes . " WHERE questions.lecture = lectures.id AND classes.code = lectures.class";
    if($course_code) {
        $qry .= " AND lectures.class = '" . $course_code . "'";
    }
    $answered = $_GET['answered'];
    if($answered == 1) {
        $qry .= " AND questions.answered = 1";
    }
    else if ($answered == 0) {
        $qry .= " AND questions.answered = 0";
    }
    $lecture = $_GET['lecture'];
    if ($lecture) {
        $qry .= " AND question.lecture = '" . $lecture . "'";
    }
    echo $qry;
    $find_questions = mysql_query($qry);
    $find_classes = mysql_query($classes);

    //get lecture info  
?>

<?php include("assets/templates/header.php"); ?>
<div class="container well" style="margin-top:130px">

    <div class="row">
        <h2 class="title text-center">Questions</h2>

        <?php 
            if ($_SESSION['type'] == "Professor"){
                ?>
                 <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">                   
                    <?php
                    while($row=mysql_fetch_array($find_questions))
                    {
                        $question_id = $row['id'];
                        $lec_num = $row['num'];
                        $topic = $row['topic'];
                        $question = $row['question'];
                        $answer = $row['answer'];
                        $creator = $row['creator'];
                        $answered = $row['answered'];           
                    ?>
                    
                    <tr>
                        <td><a href="#"></a></td>
                        <td><?php echo $question;?></td>
                        <td>Posted By:<?php echo $creator;?></td>
                        <td><?=$lec_num?></td>
                        <td><a href="questions.php?course=<?=$course_code?>&action=delete&id=<?=$question_id?>">Delete</a></td>
                        <?php 
                        if ($answered) {
                        ?>
                            <td><a href="questions.php?course=<?=$course_code?>&action=markUnanswered&id=<?=$question_id?>">Mark as Unanswered</a></td>
                        <?php
                        }
                        else {
                        ?>
                            <td><a href="questions.php?course=<?=$course_code?>&action=markAnswered&id=<?=$question_id?>">Mark as Answered</a></td>
                        <?php
                        }
                        ?>
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
                        $question_id = $row['id'];
                        $lec_num = $row['num'];
                        $topic = $row['topic'];
                        $question = $row['question'];
                        $answer = $row['answer'];
                        $creator = $row['creator'];
                        $answered = $row['answered'];          
                    ?>
                    
                    <tr>
                        <td><a href="#"></a></td>
                        <td><?php echo $question;?></td>                        
                        <td><?=$lec_num?></td>
                        <?php
                            if ($creator == $_SESSION['name']) {
                                ?>
                                <td><a href="questions.php?course=<?=$course_code?>&action=delete&id=<?=$question_id?>">Delete</a></td>
                                <?php 
                                if ($answered) {
                                ?>
                                    <td><a href="questions.php?course=<?=$course_code?>&action=markUnanswered&id=<?=$question_id?>">Mark as Unanswered</a></td>
                                <?php
                                }
                                else {
                                ?>
                                    <td><a href="questions.php?course=<?=$course_code?>&action=markAnswered&id=<?=$question_id?>">Mark as Answered</a></td>
                                <?php
                                }
                            }
                            else {
                                ?>
                                <td></td>
                                <td></td>
                                <?php
                            }
                        ?>
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