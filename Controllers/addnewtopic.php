<?php
    session_start();
    include('db_connection.php');

    $topic =addslashes($_POST['topic']);
    $content =nl2br(addslashes($_POST['content']));
    $cid = $_GET['cid'];
    $scid = $_GET['scid'];
    $replies = 0;
    $views = 0;

    // inserts the topic content into the database
    $insert = mysqli_query($conn, "INSERT INTO topics (category_id, subcategory_id, author, title, content, views, replies, date_posted) 
								          VALUES ('".$cid."', '".$scid."', '".$_SESSION['username']."', '".$topic."', '".$content."','".$views."','".$replies."', NOW());");
    // if inserted then send back to the topics page
    if ($insert)
    {
        header("Location: /topics.php?cid=".$cid."&scid=".$scid."");
    }
