<?php
session_start();

if($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Choisir...</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <?php
                echo "<a href='voter.php?'>Employeur</a>";
                echo "<a href='voter.php?>Etudiant</a>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>