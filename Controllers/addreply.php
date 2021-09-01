<?php
session_start();

include('db_connection.php'); // connection to database

$comment = nl2br(addslashes($_POST['comment']));
$cid = $_GET['cid'];
$scid = $_GET['scid'];
$tid = $_GET['tid'];
// insert the data into replies database
$insert = mysqli_query($conn, "INSERT INTO replies (category_id, subcategory_id, topic_id, author, comment, date_posted)
                                          VALUES ('".$cid."', '".$scid."', '".$tid."', '".$_SESSION['username']."', '".$comment."', NOW());");
$update = mysqli_query($conn, "UPDATE topics SET replies = replies + 1 WHERE category_id = ".$cid." AND
                                              subcategory_id = ".$scid." AND topic_id = ".$tid."");
// if inserted with data then take user to the topic they replied to
if ($insert)
{
    header("Location: /readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."");
}

