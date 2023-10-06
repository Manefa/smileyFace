<?php
    /* $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "smileface"; */

    $servername = "cours.cegep3r.info";
    $username = "2204989";
    $password = "2204989";
    $db = "2204989-yousouf-esdras-manefa";
    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
