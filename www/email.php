<?php 
    session_start();

    include("assets/templates/header.php");


    /* Redirect unauthorized user */
    if($_SESSION['type'] != "Student"){
        header('Location: http://localhost/www/index.php');
    }

    /* User sends email */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        /*connect to database */
        include("sql.php");

        $to_id = $_GET['id'];

        $sql = "SELECT email FROM users WHERE userid = '$to_id'";
        $row = mysql_fetch_array(mysql_query($sql), MYSQL_ASSOC);

        $to = $row['email'];
        $header = $_SESSION['email'];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        mail( $to, $subject, $message, $header );

        $success = "Successfully sent the email!";

    }
?>


    <div id="login-overlay" class="modal-dialog">
        <p id="success" style="font-size: 20px; color:green"><?php echo $success; ?></p>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Email Professor</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="well">
                            <form id="form" role="form" method="post" role="form">
                                <div class="form-group">
                                    <label for="email">From:</label>
                                    <input type="text" class="form-control" name="from" value="<?php echo $_SESSION['email'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Subject:</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" autofocus>
                                    <p style="color:red" id="subject_error"></p>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Message:</label>
                                    <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
                                    <p style="color:red" id="message_error"></p>
                                </div>
                                <button type="submit" class="btn btn-default">Send Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

<script type="text/javascript">

    $('#form').on('submit', function(e) {
        var subject = $('#subject');
        var message = $('#message');

        /* Check if either subject or message is blank */
        if(!subject.val()) {

            /* Error message */
            $('#subject_error').text("Subject cannot be blank!")

            /* Stop submission of the form */
            e.preventDefault();

        } else if(!message.val()) {

            /* Error message */
            $('#message_error').text("Message cannot be blank!")

            /* Stop submission of the form */
            e.preventDefault();

        }

    });

</script>

<?php include("assets/templates/footer.html"); ?>

