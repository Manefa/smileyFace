<?php
session_start();

if ($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}
require 'conf/configLocal.php';

//Page de processus des votes (transparent)

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo "Erreur";
}
if (isset($_GET['choix'])) {
    $choix = $_GET['choix'];
} elseif (isset($_POST['choix'])) {
    $choix = $_POST['choix'];
} else {
    echo "Erreur";
}
if (isset($_GET['satisfaction'])) {
    $satisfaction = $_GET['satisfaction'];
} elseif (isset($_POST['satisfaction'])) {
    $satisfaction = $_POST['satisfaction'];
} else {
    echo "Erreur";
}
echo $satisfaction;

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<b>Connected successfully</b>";
$conn->query('SET NAMES utf8');

if ($choix == 0) {
    $sql = "INSERT INTO employeesatisfaction(idEm, satisfactionlevelEm, idEv) VALUES(null, $satisfaction, $id)";
} else {
    $sql = "INSERT INTO studentsatisfaction(idEt, satisfactionlevelEt, idEv) VALUES(null, $satisfaction, $id)";
}
if (mysqli_query($conn, $sql)) {
    echo "Enregistrement réussi";
    header("Location: choisir.php?id=$id");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
