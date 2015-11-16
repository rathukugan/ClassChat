<?php include("assets/templates/header.php"); ?>

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
    include("sql.php");

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
            <div class= 'text-center'>
	            <h2 class="title text-center profile_headings">Welcome <?=$name?>, your classes:</h2>
				<div id="profile_projects">
					<table class="table table-striped" style="width: 500px;
					margin-left:auto; margin-right:auto">
					<?php
						while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
							$code = $row2['code'];
							//$id = $row2['id'];
							?>
						
							<tr><td><a href="class.php?code=<?=$code?>"><?=$code?></a></td></tr>
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
					<a href="room.php">Join other classes!</a>
				</div>
			</div>
        </div>
    </section>
<?php include("assets/templates/footer.php"); ?>