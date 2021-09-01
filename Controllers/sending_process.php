<?php
session_start();
require_once ("db_connection.php");
if(isset($_SESSION['username']) and isset ($_GET['user'])) {
    if(isset($_POST['message'])) {
        //now check for empty message
        if($_POST['message'] !='' ) {
            $message_sender = $_SESSION['username'];
            $message_reciever = $_GET['user'];
            $message = $_POST['message'];

            $q = 'INSERT INTO messages (message_sender, message_reciever, message_content, date_time)
              VALUES ("'.$_SESSION['username'].'", "'.$_GET['user'].'", "'.$_POST['message'].'", NOW());';
            $r = mysqli_query($conn, $q);

            if($r) {
                //message sent
                ?>
                <div class="grey-message">
                    <a href="#">Me</a>
                    <p><?php echo $message; ?></p>
                </div>
                <?php
            } else {
                //problem in query
                echo $q;
            }
        }
    } else {
        echo 'problem with text';
    }
} else {
    echo 'Please login or select a user to send a message';
}