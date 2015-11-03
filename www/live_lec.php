<?php
    /*connect to database */
    include("sql.php");
    $lec_id = $_GET['id'];
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
        <script type="text/javascript">
        function getDateTime() {
            var now = new Date(); 
            var year = now.getFullYear();
            var month = now.getMonth()+1; 
            var day = now.getDate();
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds(); 
            if(month.toString().length == 1) {
                var month = '0'+month;
            }
            if(day.toString().length == 1) {
                var day = '0'+day;
            }   
            if(hour.toString().length == 1) {
                var hour = '0'+hour;
            }
            if(minute.toString().length == 1) {
                var minute = '0'+minute;
            }
            if(second.toString().length == 1) {
                var second = '0'+second;
            }   
            var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
             return dateTime;
        }

        var time = getDateTime();
        setInterval(function() {   
            console.log(time);         
            $.ajax({
                url: 'questions.php',
                type: 'get',
                data: {'action': 'getNewQuestions', 'id': <?=$lec_id?>, 'time': time},
                success: function(data, status) {
                    if(data) {
                        $(".row").append("<p>" + data + </p>);
                    }
                    else {
                        console.log("no data recieved");
                    }
                },
                error: function(xhr, desc, err) {
                    console.log("error" + desc + err);//something here
                }
            }); // end ajax call
            time = getDateTime();
        }, 2000);
    </script>
    <div class="container well" style="margin-top:130px">

        <div class="row">
            <h2 class="title text-center">Questions for professor <?=$name; ?></h2>
            <?php if($_SESSION['type'] == "Student") : ?>
                        <div class="row">
                            <div class="col-xs-12">
                                    <form>
                                    <div class="form-group" style="text-align: center">
                                        <input style="width: 600px; padding: 5px" type="text" name="question" placeholder="Ask a Question!" class="inputs" required>
                                        
                                    <button type="submit" class="btn btn-theme">Send</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
            <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">
                <tr>
                    <td><a href="#"></a></td>
                    <td>What is the difference between OS pages and memory?</td>
                    <td>6:15 PM</td>
                </tr>
                <tr>
                    <td><a href="#">Me:</a></td>
                    <td>Where is the stack pointer?</td>
                    <td>6:13 PM</td>
                    <td><a href="#">Resolve</a></td>
                </tr>
                <tr>
                    <td><a href="#"></a></td>
                    <td>Why Git is better than SVN?</td>
                    <td>6:05 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#"></a></td>
                    <td>What was the average in the course in the past years?</td>
                    <td>5:55 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#"></a></td>
                    <td>Do I need any prerequisites for this course?</td>
                    <td>5:52 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#"></a></td>
                    <td>Where can I find the piazza link?</td>
                    <td>5:47 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#"></a></td>
                    <td>Could you explain the purpose of the locking system again?</td>
                    <td>5:40 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#"></a></td>
                    <td>What is the difference between A locks and B locks?</td>
                    <td>5:33 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#"></a></td>
                    <td>Why the midterm was so hard?</td>
                    <td>5:30 PM</td>
                </tr>
            </table>
            <?php endif; ?>
            <?php if($_SESSION['type'] == "Professor") : ?>
            <table class="table table-striped" style="width:600px; margin-left:auto; margin-right: auto">
                <tr>
                    <td><a href="#">Dylan:</a></td>
                    <td>What is the difference between OS pages and memory?</td>
                    <td>6:15 PM</td>
                </tr>
                <tr>
                    <td><a href="#">Bob:</a></td>
                    <td>Where is the stack pointer?</td>
                    <td>6:13 PM</td>
                </tr>
                <tr>
                    <td><a href="#">Dina:</a></td>
                    <td>Why Git is better than SVN?</td>
                    <td>6:05 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#">Julia:</a></td>
                    <td>What was the average in the course in the past years?</td>
                    <td>5:55 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#">Dylan:</a></td>
                    <td>Do I need any prerequisites for this course?</td>
                    <td>5:52 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#">Jon:</a></td>
                    <td>Where can I find the piazza link?</td>
                    <td>5:47 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#">Sarah:</a></td>
                    <td>Could you explain the purpose of the locking system again?</td>
                    <td>5:40 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#">Jon:</a></td>
                    <td>What is the difference between A locks and B locks?</td>
                    <td>5:33 PM</td>
                </tr>
                <tr class="success">
                    <td><a href="#">Jon:</a></td>
                    <td>Why the midterm was so hard?</td>
                    <td>5:30 PM</td>
                </tr>
            </table>                
            <?php endif; ?>
            <br>
            <?php 
                //$timestamp = $_REQUEST['timestamp'];
                $find_questions = "SELECT id, question, answer, creator, lecture FROM questions WHERE lecture = '$lec_id'";
                $nextresult = mysql_query($find_questions);
                while($row4 = mysql_fetch_row($nextresult, MYSQL_ASSOC)) {
                    echo("<p> '$row4[question]' '$row4[answer]' </p>");
                }  
            ?>
        </div>
            
    </div>

    

<?php include("assets/templates/footer.php"); ?>