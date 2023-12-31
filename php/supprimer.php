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
    <title>Supprimer</title>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['id'])) {
        $id = $POST['id'];
    } else {
        echo "Erreur";
    }
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
    $sql = "DELETE FROM event WHERE idEv=$id";

    if ($conn->query($sql) == TRUE) {
        echo "Record deleted successfully";
        header("Location: ../index.php");
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>