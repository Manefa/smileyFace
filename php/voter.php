<?php
session_start();

if ($_SESSION['connexion'] == false) {
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
    <title>Voter</title>
</head>

<body>
    <?php
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

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo "<a href='processus.php?id=$id&choix=$choix&satisfaction=2'>Satisfait</a>"; ?></h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo "<a href='processus.php?id=$id&choix=$choix&satisfaction=1'>Moyennement satisfait</a>"; ?></h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo "<a href='processus.php?id=$id&choix=$choix&satisfaction=0'>Pas satisfait</a>"; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>