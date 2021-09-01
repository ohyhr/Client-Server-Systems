<?php
    require_once("db_connection.php");
    if(isset($_POST['user'])) {
        $q= 'SELECT * FROM users WHERE username= "'.$_POST['user'].'"';
        $r= mysqli_query($conn, $q);
        if($r)
        {
            if(mysqli_num_rows($r) > 0) {
                //it means the user is in the database
                while ($row = mysqli_fetch_assoc($r)) {
                    $username = $row['username'];
                    //show users
                    echo '<option value="'.$username.'">';
                }
            }
            else {
                echo '<option value="no user">';
            }
        }
        else {
            echo $q;
        }
    }