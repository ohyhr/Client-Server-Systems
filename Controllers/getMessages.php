<?php
session_start();

require_once("db_connection.php");

$currentUsername = $_SESSION["username"];
$recepientUsername = $_GET["username"];
$query = "SELECT * FROM messages WHERE (message_reciever = '" . $currentUsername . "' AND message_sender = '" . $recepientUsername . "') OR (message_reciever = '" . $recepientUsername . "' AND message_sender = '" . $currentUsername . "')";
$messages = $con->query($query);
echo json_encode($messages->fetch_all());