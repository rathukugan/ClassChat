<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<?php          
    /*connect to database */
    include("sql.php");

    //Handle AJAX Post requests for editing description or deleting class.
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['desc'])) {
            $newDesc = $_POST['desc'];
            $courseCode = $_POST['code'];
              //Update database with new edit
            $SQLEditDescrip = "UPDATE classes SET description='$newDesc' WHERE code='$courseCode'"; 
            $update = mysql_query($SQLEditDescrip);

            exit;
        }

        if(isset($_POST['del'])) {
            $courseCode = $_POST['code'];
              //Update database with new edit
            $SQL_del_class = "DELETE FROM classes WHERE code='$courseCode'"; 
            $SQL_del_students = "DELETE FROM students WHERE code='$courseCode'"; //Remove students from class that just got deleted.
            $SQL_del_lectures= "DELETE FROM lectures WHERE class='$courseCode'";
            $delete = mysql_query($SQL_del_class);
            $delete1 = mysql_query($SQL_del_students);
            $delete2 = mysql_query($SQL_del_lectures);

            exit;
        }

    }
?>

<script type="text/javascript">
  $(document).ready(function() {
    var courseURL = $('#courseCode').text();

    var origDesc = $('#desc').html();
    var descrip = $('#desc').text()
    var editDesc = '<input id="newVal" type="text" class="form-control" placeholder="' + descrip + '"> <a id="save" class="btn btn-theme" href="#">Save</a> <a id="cancel" class="btn btn-theme" onclick="" href="#">Cancel</a>';
    $('#edit').click(function() {
        $('#desc').html(editDesc);

        $('#cancel').click(function() {
            $('#desc').html(origDesc);
        });

        $('#save').click(function() {
            descrip = $("#newVal").val(); 

            var dataObj = {};

            dataObj["desc"]=descrip;
            dataObj["code"]=courseURL;

            $.ajax({
               type: "POST",
               data: dataObj,
               success: function(){
                 alert("Description changed.");
                 $('#desc').html(origDesc).text(descrip);
               }
            });

        });

    });

    //'#del' is the delete button in the popup modal
    $('#del').click(function() {
        var dataObj = {};
        dataObj["del"]="Yes";
        dataObj["code"]=courseURL;

        $.ajax({
           type: "POST",
           data: dataObj,
           success: function(){
             alert("Class Deleted. Redirecting to My Classes.");
             window.location.href = "profile.php";
           }
        });
    });

  });
</script>

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
    $code = $_GET['code'];
    $SQL = "SELECT * FROM classes WHERE code= '$code'";
    $result = mysql_query($SQL);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);

    //get project info
    $courseID = $row['id'];
    $code = $row['code'];
    $desc = $row['description'];
    $creator = $row['creator'];
    $date = process_date($row['date']);
    $invite = $row['invite'];
	
	//get creator info
	$SQL = "SELECT * FROM users WHERE email = '$creator'";
	$result = mysql_query($SQL);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
	$creatorname = $row['name'];

    $creatorId = $row['userid'];

?>

<!-- Page Content -->
    <br>
    <br>
    <br>
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1 id="courseCode"><?=$code?></h1>

                <!-- Author -->
                <p class="lead" style="display: inline-block">
                    by <?=$creatorname?>
                </p>

                <?php
                    if ($_SESSION['type'] == "Student"){
                        ?>
                        <a href="email.php?id=<?php echo $creatorId; ?>">
                            <button style="margin-left: 20px; margin-bottom: 5px" type="button" class="btn btn-info">Email the Professor</button>
                        </a>
                        <?php
                    }
                    ?>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Created on <?=$date?></p>

                <hr>

                <!-- Post Content -->
                <h4> Class Description </h4>
                <div id="desc"><p class="lead"><?=$desc?></p></div>

                <hr>

                <h4> View Questions </h4>
                <a class="btn btn-theme" href="questions.php?course=<?=$code?>">View Questions</a>

                <hr>
                <h4> Invitation code:  <?=$invite?></h4>
                <hr>
                <br>
                <br>
                <br>
                <br>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <br>
            <div class="col-md-4">

                <!-- Edit and Delete idea buttons -->
                <?php 
                $currentemail = $_SESSION['email'];
                //$creator = "'".$creator."'";
                if (strcmp($currentemail, $creator) == 0){
                    ?>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure you want to delete this class?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="del">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Side Widget Well -->
                    <div class="well">
                        <div class="text-center">
                        <a class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete Class</a>
                        <a id="edit" class="btn btn-success" href="#">Edit Class</a>
                        <a class="btn btn-primary" href="new_lecture.php?course=<?=$code?>">New Lecture</a>
                        </div>
                    </div>
                    <?php
                    }
                ?>
                <!-- Funding Info Well -->
                <div class="well">
                    <h4>Lectures</h4>
                    <!--Likes -->
                    <div class="row">
                    <?php
                        $SQL2 = "SELECT * FROM lectures WHERE class = '$code'";
                        $result2 = mysql_query($SQL2);
                        
                        while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
                            $title = "Lecture " . $row2['num'];
                            $id = $row2['id'];
                            ?>
                            <div class="col-sm-6 col-lg-6">
                                <p><a href="live_lec.php?id=<?=$id?>"><?=$title?></a></p>
                            </div>
                        <?php 
                        }
                    ?>
                    </div>

                    
                </div>

                
            </div>

        </div>
        <!-- /.row -->
    </div>
<br>
<br>
<br>
<?php include("assets/templates/footer.php"); ?>