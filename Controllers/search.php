<?php

require_once('Models/DB.php');

$content = $_POST['content'];
$con = new DB();
$data = $con->searchData($content);

echo json_encode($data);