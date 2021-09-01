<?php
include('db_connection.php');
$submitted = $_POST['sub'];
$topic = $_GET['tid'];
$user = $_GET['uid'];
//echo $checkbox;

//subscribes the user to that topic when button is pressed
if (isset($submitted)) {
    $exists = mysqli_query($conn, "SELECT subscriber_id, topic_id FROM subscriptions WHERE subscriber_id = '".$user."' AND topic_id = '".$topic."'");
    if(mysqli_num_rows($exists) != 0)
    {
        $remove = mysqli_query($conn, "DELETE FROM subscriptions WHERE (subscriber_id = '".$user."') AND (topic_id = '".$topic."')");
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $insert = mysqli_query($conn, "INSERT INTO subscriptions(subscriber_id, topic_id) VALUES ('".$user."', '".$topic."')");
        if($insert) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
}