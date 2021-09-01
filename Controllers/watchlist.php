<?php
function dispsubscriptions($uid) // function for displaying subscriptions to the user
{
    //echo $uid;
    include('db_connection.php');
    $sql2 = mysqli_query($conn, "SELECT user_id FROM users WHERE (username = '$uid') ");
    $result2 =mysqli_fetch_assoc($sql2);
    $userid = $result2['user_id'];
    //echo $userid;
    $select = mysqli_query($conn, "SELECT topic_id FROM subscriptions INNER JOIN users ON subscriptions.subscriber_id = users.user_id WHERE (users.user_id = '$userid') ORDER BY topic_id DESC");
    echo "<table class='topic-table'>";
    echo "<tr><th>Title</th><th>Posted By</th><th>Date Posted</th><th>Views</th><th>Replies</th></tr>";
    while ($row1 = mysqli_fetch_assoc($select)) {
        $topic =  $row1['topic_id'];
        //echo $topic;
        $sql = mysqli_query($conn, "SELECT topic_id,category_id,subcategory_id,author,title,date_posted,views,replies FROM topics WHERE (topic_id = '$topic')");
        $result = $result =mysqli_fetch_assoc($sql);
        echo "<tr><td><a href='/readtopic.php?cid=".$result['category_id']."&scid=".$result['subcategory_id']."&tid=".$result['topic_id']."'>
			" . $result['title'] . "</a></td><td>" . $result['author'] . "</td><td>" . $result['date_posted'] . "</td><td>" . $result['views'] . "</td>
                     <td>" . $result['replies'] . "</td></tr>";
    }
    echo "</table>";
}

