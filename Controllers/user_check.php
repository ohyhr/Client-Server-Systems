<?php
    require_once("db_connection.php");
    if(isset($_POST['user'])) {
        $q= 'SELECT * FROM `users` WHERE `username`= "'.$_POST['user'].'"';
        $r= mysqli_query($conn, $q);
        if($r)
        {
            if(mysqli_num_rows($r) > 0) {
                echo '<p>User already registered</p>';
            }
            else {
                echo '<p>You can take this name</p>';
            }
        }
        else {
            echo $q;
        }
    }