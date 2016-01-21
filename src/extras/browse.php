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
    /*connect to database */
    $user_name = "root";
    $pass_word = "csc309";
    $database = "startit";
    $server = "104.236.231.174:3306";;

    $db_handle = mysql_connect($server, $user_name, $pass_word);
    $db_found = mysql_select_db($database, $db_handle);
?>
<div class="container" style="margin-top:80px">
    <div class="row">
        <div class="col-md-2">
            <h3>Types</h3>
            <div class="list-group">
                <a href="browse.php" class="list-group-item">All</a>
                <a href="browse.php?category=<?='Technology'?>" class="list-group-item">Technology</a>
                <a href="browse.php?category=<?='Health'?>" class="list-group-item">Health</a>
                <a href="browse.php?category=<?='Education'?>" class="list-group-item">Education</a>
                <a href="browse.php?category=<?='Finance'?>" class="list-group-item">Finance</a>
                <a href="browse.php?category=<?='Travel'?>" class="list-group-item">Travel</a>
                <a href="browse.php?category=<?='Film and Video'?>" class="list-group-item">Film and Video</a>
                <a href="browse.php?category=<?='Design'?>" class="list-group-item">Design</a>
                <a href="browse.php?category=<?='Games'?>" class="list-group-item">Games</a>
            </div>
            <!-- tags -->
            <h3>Tags</h3>
            <div class="list-group">
                <?php
                $tagitems = array();
                $tagsresult = mysql_query("SELECT * FROM tags");
                while ($row = mysql_fetch_array($tagsresult, MYSQL_ASSOC)){
                    $tag = $row['tag'];
                    
                    if (!(in_array($tag, $tagitems))) {
                        $tagitems[] = $tag;
                ?>
                <a href="browse.php?tag=<?=$tag?>" class="list-group-item"><?=$tag?></a>
                <?php
                    }
                }
                ?>
            </div>
            
        </div>
        <div class="col-md-10">
            <h3>Ideas</h3>
            <div class="row">
                <?php          
                    //Check if filter is set
                    if (isset($_GET['category'])) {
                        $category = $_GET['category'];
                        $SQL = "SELECT * FROM projects WHERE category = '$category'";
                    } else {
                        $SQL = "SELECT * FROM projects";
                    }

                    if (isset($_GET['tag'])) {
                        $tag = $_GET['tag'];
                        $SQL = "SELECT DISTINCT * FROM projects inner join tags on projects.pID=tags.pID and tags.tag='$tag'";
                    }
                    //add this to add filters

                    $result = mysql_query($SQL);

                    //retrieve data from sql server
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                        $title = $row['title'];
                        $id = $row['pID'];
                        $desc = $row['description'];
                        $creator = $row['creator'];
                        $liked = $row['likes'];
                        $disliked = $row['dislikes'];
                        $category = $row['category'];

                        //get the name of the owner of project
                        $SQL2 = "SELECT * FROM users WHERE email = '$creator'";
                        $result2 = mysql_query($SQL2);
                        $row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
                        $name = $row2['name'];

                        //render project box
                        ?> 
                        <div class="col-sm-6 col-lg-6">
                            <div class="thumbnail">
                                <div class="caption">

                                    <!-- Idea Descriptions and stuff -->
                                    <h4><a href="idea.php?id=<?=$id?>"><?=$title?></a>       
                                    <p>Created by: <?=$name?></p>    
                                    <p><span class="glyphicon glyphicon-tags"></span> Tags: 
                                    <?php
                                        $tagz = array();
                                        $results = mysql_query("SELECT * FROM tags WHERE pID=$id");
                                        while($row = mysql_fetch_array($results, MYSQL_ASSOC)){
                                            $tag = $row['tag'];
                                                if (!(in_array($tag, $tagz))) {
                                                $tagz[] = $tag;
                                            ?>
                                            <a href="browse.php?tag=<?=$tag?>"><?=$tag?></a>
                                            <?php
                                            }
                                        } ?>
                                    </p>                  
                                    <p class="smallaf"><?=$desc?></p>
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
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                ?> 
            </div>
        </div>
    </div>
</div>
<?php include("assets/templates/footer.php"); ?>