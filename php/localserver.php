<?php
session_start();
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "smileface";
    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>