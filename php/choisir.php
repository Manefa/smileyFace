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
    <title>Choisir...</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } elseif (isset($_POST['id'])) {
                    $id = $_POST['id'];
                } else {
                    echo "Erreur";
                }
                //choix 0 = employeurs
                //choix 1 = etudiant
                ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo "<a href='voter.php?id=$id&choix=0'>Employeur</a>"; ?></h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo "<a href='voter.php?id=$id&choix=1'>Etudiant</a>"; ?></h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>