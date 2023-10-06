<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: ../pages/connexion.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../assets/logo.svg">
    <title>Supprimer Utilisateur</title>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $idUtilisateur = $_GET['id'];
    } elseif (isset($_POST['id'])) {
        $idUtilisateur = $_POST['id'];
    } else {
        echo "Erreur : ID d'utilisateur non spécifié.";
    }

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "smileface";

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    $conn->query('SET NAMES utf8');

    $sql = "DELETE FROM user WHERE idUser = $idUtilisateur";

    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur supprimé avec succès";
        header("Location: ../pages/user.php"); // Redirigez vers une page de liste d'utilisateurs ou une autre page appropriée.
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $conn->error;
    }

    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
