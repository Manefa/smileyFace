<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}
require 'conf/configServeur.php';
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
    <title>Afficher</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th scope="col">IdEm</th>
                            <th scope="col">Niveau de satisfaction</th>
                            <th scope="col">IdEv</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                        } elseif (isset($_POST['id'])) {
                            $id = $_POST['id'];
                        } else {
                            echo "Erreur";
                        }

                        $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $conn->query('SET NAMES utf8');
                        $sql1 = "SELECT * FROM employeesatisfaction WHERE idEv = $id";

                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                echo "<tr>" . " <th scope = 'row'> " . $row["idEm"] . "</th>" . "<td>" . $row["satisfactionlevelEm"] . "</td>" . "<td>" . $row["idEv"] . "</td>" . "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                    </tbody>
                </table>

                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th scope="col">IdEt</th>
                            <th scope="col">Niveau de satisfaction</th>
                            <th scope="col">IdEv</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "root";
                        $db = "bdsmileyface";

                        $conn = new mysqli($servername, $username, $password, $db);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $conn->query('SET NAMES utf8');
                        $sql2 = "SELECT * FROM studentsatisfaction WHERE idEv = $id ";

                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                echo "<tr>" . " <th scope = 'row'> " . $row["idEt"] . "</th>" . "<td>" . $row["satisfactionlevelEt"] . "</td>" . "<td>" . $row["idEv"] . "</td>" . "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>