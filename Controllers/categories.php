<?php
function dispcategoires()
{
    include('controllers/db_connection.php');
    $select = mysqli_query($conn, "SELECT * FROM categories");
    while ($row = mysqli_fetch_assoc($select))
    {
        echo "<table class='category-table' style='width:100%; margin-bottom: 5px; margin-top:5px;'>";
        echo "<tr><td class='main-category' colspan='2' style='font-size:28px; font-weight:bold;'>" . $row['category_title'] . " </td></tr>";
        dispsubcategories($row['cat_id']);
        echo "</table>";
    }
}

function dispsubcategories($parent_id)
{
    include('controllers/db_connection.php');
    $select = mysqli_query($conn, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
    echo "<tr><th width='90%'>Categories</th><th width='10%' style='text-align: center;'>Topics</th></tr>";
    while ($row = mysqli_fetch_assoc($select))
    {
        echo "<tr><td class='category_title'><a style='font-size:22px;' href='topics.php?cid=".$row['cat_id']."&scid=".$row['subcat_id']."'>".$row['subcategory_title']."</a>";
        echo "<p style='font-size:16px'>".$row['subcategory_desc']."</p></td>";
        echo "<td class='num-topics' style='text-align: center;'>".getnumtopics($parent_id, $row['subcat_id'])."</td></tr>";  // calls other function for getting number of topics
    }
}
function getnumtopics($cat_id, $subcat_id)
{
    include('controllers/db_connection.php');
    $select = mysqli_query($conn, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id  AND ".$subcat_id." = subcategory_id");
    return mysqli_num_rows($select); // returns number of topics
}
?>