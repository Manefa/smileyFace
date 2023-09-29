<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer</title>
</head>

<body>
    <?php
    if (isset($_SESSION["connexion"])  && $_SESSION["connexion"] == true) {


    ?>
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
        }
        //header("Location: ../index.php");
        $conn->close();
        ?>
    <?php
    } else {
        header("Location: pages/connexion.php");
    }
    ?>
</body>

</html>