<?php include("assets/templates/header.php"); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<?php          
	session_start();
    /*connect to database */
    include("sql.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $courseCode = $_POST['code'];

	    $email = $_SESSION['email'];

        $SQL_del_students = "DELETE FROM students WHERE code='$courseCode' AND email='$email'"; //Remove students from class that just got deleted.
        $delete = mysql_query($SQL_del_students);

        exit;
    }
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

    $find_questions = mysql_query("SELECT questions.id, question, answer, creator, topic, num, answered FROM lectures, questions WHERE lectures.id = questions.lecture AND questions.creator = '" . $_SESSION['name'] . "'");
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.rem').on('click', function() {
			var courseCode = $(this).next().text();
			$('#dropCourse').text(courseCode);

			$('#del').click(function() {
		        var dataObj = {};

		        dataObj["code"]=courseCode;

		        $.ajax({
		           type: "POST",
		           data: dataObj,
		           success: function(){
		             window.location.href = "profile.php";
		           }
		        });
			});
		});
	});
</script>

<?php
function process_date($raw_date) {
	$date_elements[0] = substr($raw_date, 0, 4);
	$date_elements[1] = substr($raw_date, 5, 2);
	$date_elements[2] = substr($raw_date, 8, 2);
	switch ($date_elements[1]) {
		case "01":
			$month ="January";
			break;
		case "02":
			$month ="February";
			break;
		case "03":
			$month ="March";
			break;
		case "04":
			$month ="April";
			break;
		case "05":
			$month ="May";
			break;
		case "06":
			$month ="June";
			break;
		case "07":
			$month ="July";
			break;
		case "08":
			$month ="August";
			break;
		case "09":
			$month ="September";
			break;
		case "10":
			$month ="October";
			break;
		case "11":
			$month ="November";
			break;
		case "12":
			$month ="December";
			break;
	}
	return $month . " " . $date_elements[2] . ", " . $date_elements[0];
}

?>
<?php
//TODO: Need to add code to check if the user logged in is viewing the profile, to determine if edit button and other stuff should be visible.
	$email = $_SESSION['email'];
	$email = htmlspecialchars($email);

	/*connect to database */
    //include("sql.php");

    $SQL = "SELECT * FROM users WHERE email = '$email'";
    $result = mysql_query($SQL);

    //retrieve user data from sql server and web server.
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $name = $row['name'];
	$email = $row['email'];
	$user_id = $row['userid'];
	
	if ($_SESSION['type'] == "Student") {
		$SQL2 = "SELECT * FROM students WHERE email = '$email'";
	}
	else {
		$SQL2 = "SELECT * FROM classes WHERE creator = '$email'";
	}

	$result2 = mysql_query($SQL2);
?>
    <section id="profile">
        <div class="container">
            <br>
            <br>
            <br>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="dropCourse" class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to drop this class?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="del">Drop</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                </div>

              </div>
            </div>
            <div class= 'text-center'>
	            <h2 id="headerName" class="title text-center profile_headings">Welcome <?=$name?>, your classes:</h2>
				<div id="profile_projects">
					<table class="table table-striped" style="width: 500px;
					margin-left:auto; margin-right:auto">
					<?php
						while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
							$code = $row2['code'];
							//$id = $row2['id'];
							?>
						
							<tr><td>
							<a class="rem" data-toggle="modal" data-target="#myModal" href="#"><i style="font-size: 25px" class="pull-left remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
  							<a style="font-size: 25px" href="class.php?code=<?=$code?>"><?=$code?></a></td></tr>
						<?php 
						}
						if (!isset($code) && ($_SESSION['type'] == "Professor")){
							?>
							<tr> <td><p>You have not made any classes yet!</p>
							<p> <a href="create.php">Create</a> a class now! </p></td></tr>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<?php
						}
					?>
					</table>
					<a style="font-size: 15px; margin-left: 30px" href="room.php">Join other classes!</a>
				</div>
				<h2 id="headerName" class="title text-center profile_headings">Questions You asked:</h2>
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
                            <td><a href="profile.php?course=<?=$course_code?>&action=delete&id=<?=$question_id?>">Delete</a></td>
                            <?php 
                            if ($answered) {
                            ?>
                                <td><a href="profile.php?course=<?=$course_code?>&action=markUnanswered&id=<?=$question_id?>">Mark as Unanswered</a></td>
                            <?php
                            }
                            else {
                            ?>
                                <td><a href="profile.php?course=<?=$course_code?>&action=markAnswered&id=<?=$question_id?>">Mark as Answered</a></td>
                            <?php
                            }
                            ?>
	                    </tr>
	                  
                    <?php
                }
            } ?>
            	</table>
			</div>
        </div>
    </section>
<?php include("assets/templates/footer.php"); ?>