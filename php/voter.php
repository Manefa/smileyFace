<?php
session_start();

if ($_SESSION['connexion'] == false) {
    header("Location: ../pages/connexion.php");
}


//Page de processus des votes (transparent)

if (isset($_GET['profil'])) {
    $profil = $_GET['profil'];
}

if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];
}

if (isset($_GET['vote'])) {
    $vote = $_GET['vote'];
}

var_dump($profil);
var_dump($eventId);
var_dump($vote);

$servername = "localhost";
$username = "root";
$password = "root";
$db = "smileface";

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<b>Connected successfully</b>";
$conn->query('SET NAMES utf8');

if ($profil == 1) {
    $sql = "INSERT INTO studentsatisfaction(idEt, satisfactionlevelEt, idEv) VALUES(null, $vote, $eventId)";
} else {
    $sql = "INSERT INTO employeesatisfaction(idEm, satisfactionlevelEm, idEv) VALUES(null, $vote, $eventId)";
}
if (mysqli_query($conn, $sql)) {
    echo "Enregistrement réussi";
    header("Location: ../pages/evaluation.php?eventId=$eventId&profil=$profil");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
