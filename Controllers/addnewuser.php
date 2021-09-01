<?php
    include('db_connection.php'); // for database connection
    include('cryptor.php');  // for encryption

    $newuser = $_POST['usernameinput'];

    $oldpass = $_POST['passwordinput'];
    $newpwd = cryptor_crypt($oldpass, 'e');  // encrypts password
    $newemail = $_POST['emailinput'];

    // validation for registration
    if(($newuser and $newpwd and $newemail) == !null)
    {
        // inserts the data into the database
        $insert = mysqli_query($conn, "INSERT INTO users (username, password, email)
                                          VALUES ('" . $newuser . "', '" . $newpwd . "', '" . $newemail . "')");
        // if inserted successfully then give status reg_success
        if ($insert)
        {
            header("Location: /login.php");
        }
    }
    else // give status incorrect
    {
    header("Location: /register.php?status=invalid");
    }

