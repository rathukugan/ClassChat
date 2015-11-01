<?php
    $lec_id = $_GET['id'];

    /*connect to database */
    include("sql.php");

    //find lecture by id from GET
    $find_lecture = "SELECT class, topic, num FROM lectures WHERE id = '$lec_id'";

    //get lecture info
    $row = mysql_fetch_array(mysql_query($find_lecture), MYSQL_ASSOC);
    $lec_num = $row['num'];
    $course = $row['class'];
    $topic = $row['topic'];

    //get course info
    $find_course = "SELECT creator FROM classes WHERE code = '$course'";

    //grab course code
    $row2 = mysql_fetch_array(mysql_query($find_course), MYSQL_ASSOC);
    $creator_email = $row2['creator'];

    //grab proff name
    $find_proff = "SELECT name FROM users WHERE email = '$creator_email'";

    //get proff name
    $row3 = mysql_fetch_array(mysql_query($find_proff), MYSQL_ASSOC);
    $name = $row3['name'];

    /* =============== TODO: make live questions popup and store them in questions database ======= */

?>
<?php include("assets/templates/header.php"); ?>
    <div class="container well" style="margin-top:130px">
        <div class="row">
            <h2 class="title text-center"> Live Lecture</h2>
            <h4 class="title text-center">Lecture id: <?=$lec_id?> </h4>
            <h4 class="title text-center">Lecture topic: <?=$topic?> </h4>
            <h4 class="title text-center">Course: <?=$course?> </h4>
            <h4 class="title text-center">Professor: <?=$name?> </h4>

            <br>
            
        </div>
    </div>

    <?php if($_SESSION['type'] == "Student") : ?>
        <div class="container well" style="margin-top:50px">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="well">
                            <div class="form-group">
                                <input  class="form-control" type="text" name="question" placeholder="Ask a Question!" class="inputs" required><br>
                                <span class="help-block"></span>
                            </div>
                            <button type="submit" class="btn btn-theme btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    <?php endif; ?>

    <div class="container well" style="margin-top:130px">
        <div class="row">
            <h2 class="title text-center"> Questions</h2>

            <br>
            
        </div>
    </div>
<?php include("assets/templates/footer.php"); ?>