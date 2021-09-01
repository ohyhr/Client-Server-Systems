<?php

session_start();
require_once("db_connection.php");
$sender_name = ($_SESSION['username']);
$receiver_name = ($_POST['username']);
$message = ($_POST['message']);

$q = "INSERT INTO messages (message_sender, message_receiver, message_context, date_time) 
        VALUES('$sender_name', '$receiver_name', '$message', NOW());";

$r = mysqli_query($conn, $q);
