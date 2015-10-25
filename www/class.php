<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
    /*connect to database */
    include("sql.php");

    $code = $_GET['code'];
    $SQL = "SELECT * FROM classes WHERE code= '$code'";
    $result = mysql_query($SQL);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);

    //get project info
    $code = $row['code'];
    $desc = $row['description'];
    $creator = $row['creator'];
    $date = process_date($row['date']);
	
	//get creator info
	$SQL = "SELECT * FROM users WHERE email = '$creator'";
	$result = mysql_query($SQL);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
	$creatorname = $row['name'];
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
                <h1><?=$code?></h1>


                <!-- Author -->
                <p class="lead">
                    by <?=$creatorname?>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Created on <?=$date?></p>

                <hr>

                <!-- Post Content -->
                <h4> Class Description </h4>
                <p class="lead"><?=$desc?></p>

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
                    <!-- Side Widget Well -->
                    <div class="well">
                        <div class="text-center">
                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="#">Delete Class!</a>
                        <a class="btn btn-success" href="#">Edit Class!</a>
                        <a class="btn btn-primary" href="#>">New Lecture!</a>
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
                            $title = "Lecture " . $row2['number'];
                            $id = $row2['id'];
                            ?>
                            <div class="col-sm-6 col-lg-6">
                                <p><a href="#"><?=$title?></a></p>
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