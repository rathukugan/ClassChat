<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $(".like").click(function()
        {
            var id=$(this).attr("id");
            var name=$(this).attr("name");
            var dataString = 'id='+ id;
            var parent = $(this);

            if (name=='up'){
                $(this).fadeIn(100).html('<img src="/assets/img/loading.gif" height="42" width="42"/>');
                $.ajax
                ({
                    type: "POST",
                    url: "upvote.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        parent.html(html);
                    } 
                });
            } else {
                $(this).fadeIn(10).html('<img src="/assets/img/loading.gif" height="42" width="42"/>');
                $.ajax
                ({
                    type: "POST",
                    url: "downvote.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        parent.html(html);
                    } 
                });
            }
        });

        // Close button action
        $(".close").click(function()
        {
            $("#votebox").slideUp("slow");
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
    /*connect to database */
    $user_name = "root";
    $pass_word = "csc309";
    $database = "startit";
    $server = "104.236.231.174:3306";;
    
    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db($database, $db_handle);

    $id = $_GET['id'];
    $SQL = "SELECT * FROM projects WHERE pID = $id";
    $result = mysql_query($SQL);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);

    //get project info
    $title = $row['title'];
    $id = $row['pID'];
    $desc = $row['description'];
    $creator = $row['creator'];
    $liked = $row['likes'];
    $disliked = $row['dislikes'];
    $category = $row['category'];
    $date = process_date($row['createdate']);
    $percentage = round(($liked / ($liked + $disliked)) * 100);

    //get tags
    
	
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
                <h1><?=$title?></h1>

                <!-- Category -->
                <h4><?=$category?></h4>

                <!-- Author -->
                <p class="lead">
                    by <?=$creatorname?>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Created on <?=$date?></p>

                <!-- Tags -->
                <p><span class="glyphicon glyphicon-tags"></span> Tags: 
                <?php
                    $tagitems = array();
                    $result = mysql_query("SELECT * FROM tags WHERE pID=$id");
                    while($row2 = mysql_fetch_array($result, MYSQL_ASSOC)){
                        $tag = $row2['tag'];
                            if (!(in_array($tag, $tagitems))) {
                            $tagitems[] = $tag;
                        ?>
                        <a href="browse.php?tag=<?=$tag?>"><?=$tag?></a>
                        <?php
                        }
                    } ?>
                </p>
                <hr>

                <!-- Post Content -->
                <h4> Idea Description </h4>
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
                $creator = "'".$creator."'";
                if (strcmp($currentemail, $creator) == 0){
                    ?>

                    <!-- Side Widget Well -->
                    <div class="well">
                        <div class="text-center">
                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="delete.php?id=<?=$id?>">Delete!</a>
                        <a class="btn btn-success" href="edit.php?id=<?=$id?>">Edit!</a>
                        </div>
                    </div>
                    <?php
                    }
                ?>
                <!-- Funding Info Well -->
                <div class="well">
                    <h4>Likes</h4>
                    <!--Likes -->
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <p>
                                <div class='up'>
                                <a href="" class="like" name="up" id="<?php echo $id; ?>"><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo $liked; ?> liked!</a>
                                </div>
                            </p>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <p>
                                <div class='down'>
                                <a href="" class="like" name="down" id="<?php echo $id; ?>"><span class="glyphicon glyphicon-thumbs-down"></span> <?php echo $disliked; ?> disliked!</a>
                                </div>
                            </p>
                        </div>
                    </div>

                    <!-- Progress bar -->
                    <div class="progress">
                         <div class="progress-bar" role="progressbar" aria-valuenow=<?=$percentage?>
                            aria-valuemin="0" aria-valuemax="100"  style='min-width: 2em; width:<?=$percentage?>%'>
                            <?=$percentage?>% like this idea!
                        </div>
                    </div>
                </div>

                
            </div>

        </div>
        <!-- /.row -->
    </div>

<?php include("assets/templates/footer.php"); ?>