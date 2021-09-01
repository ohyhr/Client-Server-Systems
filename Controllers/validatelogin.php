<?php
    session_start();
    include('db_connection.php');
    include('cryptor.php');
    $username = $_POST['usernameinput'];
    $oldpass = $_POST['passwordinput'];
    $password = cryptor_crypt($oldpass, 'e');

    $result = mysqli_query($conn, "SELECT user_id, username, password FROM users WHERE username = '".$username."' AND password = '".$password."'");

    if (mysqli_num_rows($result) != 0) // checks if data matches database
    {
        $rows = mysqli_fetch_assoc($result);
        $_SESSION['uid'] = $rows['user_id'];
        $_SESSION['username'] = $rows['username'];
        header("Location: /");
    }
    else
    {
        header("Location: /login.php?status=invalid");
    }