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

//var_dump($profil);
//var_dump($eventId);
//var_dump($vote);

$servername = "localhost";
$username = "root";
$password = "root";
$db = "smileface";

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query('SET NAMES utf8');

if ($profil == 1) {
    $sql = "INSERT INTO studentsatisfaction(idEt, satisfactionlevelEt, idEv) VALUES(null, $vote, $eventId)";
} else {
    $sql = "INSERT INTO employeesatisfaction(idEm, satisfactionlevelEm, idEv) VALUES(null, $vote, $eventId)";
}
if (mysqli_query($conn, $sql)) {
    echo '<script>
          setTimeout(function(){
              window.location.href = "../pages/evaluation.php?eventId=' . $eventId . '&profil=' . $profil . '";
          }, 2000); // Redirection après 3 secondes (3000 millisecondes)
      </script>';

    //header("Location: ../pages/evaluation.php?eventId=$eventId&profil=$profil");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <img src="../assets/Feedback-cuate.svg" class="img-fluid" alt="" srcset="">
            </div>

            <h1 class="text-center">Merci d'avoir voter</h1>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>