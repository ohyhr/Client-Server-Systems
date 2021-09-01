<?php
// connects to db
$host = "poseidon.salford.ac.uk";
$username = "sgb989";
$password = "cssa1database";
$dbname = "sgb989";
// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);


//check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//echo "Connected successfully";
