<?php
	include("sql.php");
	if($_GET['action'] == "getNewQuestions") {
        $lec_id = $_GET['id'];
        $time = $_GET['time'];
        $find_questions = "SELECT id, question, answer, creator, lecture, postTime FROM questions WHERE lecture = '$lec_id' AND postTime > '$time'";
        $nextresult = mysql_query($find_questions);
        $question = mysql_fetch_row($nextresult, MYSQL_ASSOC)['answer'];
        echo($question);
    }
?>