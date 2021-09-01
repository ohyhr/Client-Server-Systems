<?php
function disptopics($cid, $scid) // function for displaying topics
{
    include ('controllers/db_connection.php');
    // selects all topic information to be displayed to the user on the topics page when you click on a subcategory
    $select = mysqli_query($conn, "SELECT DISTINCT topic_id, author, title, date_posted, views, replies FROM categories, subcategories, topics
                                              WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid = categories.cat_id)
									          AND ($scid = subcategories.subcat_id) ORDER BY topic_id DESC");
    // if not null then create a table to display the data
    if (mysqli_num_rows($select) !=0)
    {
        echo "<table class='topic-table' style='width:100%; margin-bottom: 5px; margin-top:5px;'>";
        echo "<tr><th width='10%'>Title</th><th width='10%'>Posted By</th><th width='10%'>Date Posted</th><th width='10%' style='text-align: center;'>Views</th><th width='10%' style='text-align: center;'>Replies</th></tr>"; // titles
        while ($row = mysqli_fetch_assoc($select)) // for the fetched data
        {
            echo "<tr><td><a href='/readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$row['topic_id']."'>
					 ".$row['title']."</a></td><td>".$row['author']."</td><td>".$row['date_posted']."</td><td>".$row['views']."</td>
					 <td>".$row['replies']."</td></tr>";
        }
        echo "</table>";
    }
    else // if no topics then show this
    {
        echo "<p>this category has no topics yet! add the very first topic!</a></p>";
    }
}

function countReplies($cid, $scid, $tid) // function for counting the number of replies a post has
{
    include ('db_connection.php');
    // checks how many replies a post has
    $select = mysqli_query($conn, "SELECT category_id, subcategory_id, topic_id FROM replies WHERE ".$cid." = category_id AND 
                                      ".$scid." = subcategory_id AND ".$tid." = topic_id");
    return mysqli_num_rows($select); // returns the number of replies
}

function disptopic($cid, $scid, $tid) // function for displaying a topic
{
    include('controllers/db_connection.php');
    // selects the data for the category, subcategory, topic where they all match up to show the correct topic from the database
    $select = mysqli_query($conn, "SELECT cat_id, subcat_id, topic_id, author, title, content, date_posted FROM
                                              categories, subcategories, topics WHERE ($cid = categories.cat_id) AND 
                                              ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
    $row = mysqli_fetch_assoc($select); // fetches the select statement as long as its not null
    echo nl2br("<div class='content'><h2 class='title'>".$row['title']."</h2><p>".$row['author']."\n".$row['date_posted']."</p></div>"); // presents the topic
    echo "<div class='content'><p>".$row['content']."</p></div>";
}

function addview($cid, $scid, $tid) // function for adding a view to the topic
{
    include('db_connection.php');
    // updates the view to go up when called
    $update = mysqli_query($conn, "UPDATE topics SET views = views + 1 WHERE category_id = ".$cid." AND
                                              subcategory_id = ".$scid." AND topic_id = ".$tid."");
}

function dispreplies($cid, $scid, $tid) // function for displaying replies to a post
{
    include ('db_connection.php');
    // selects reply data from categories, subcategories, topics, replies where the cid, scid and tid all line up correctly, then organises reply_id in descending order
    $select = mysqli_query($conn, "SELECT replies.author, comment, replies.date_posted FROM categories, subcategories, 
                                             topics, replies WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
                                             AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
                                             ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id DESC");
    if (mysqli_num_rows($select) != 0) // if not null then do create the reply table
    {
        echo "<div class='content'><table class='reply-table'>";
        while ($row = mysqli_fetch_assoc($select))
        {
            echo nl2br("<tr><th width='15%'>".$row['author']."</th><td>".$row['date_posted']."\n".$row['comment']."\n\n</td></tr>");
        }
        echo "</table></div>";
    }
}

function replytopost($cid, $scid, $tid) // function for replying to post
{
    echo "<div class='content'><form action='controllers/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
              <p>Comment: </p>
              <textarea style='width:900px;' cols='80' rows='5' id='comment' name='comment'></textarea><br />
              <input type='submit' value='add comment' />
              </form></div>";
}