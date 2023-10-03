<?php
session_start();

if ($_SESSION['connexion'] == false) {
    header("Location: php/connexion.php");
}
require 'php/conf/configServeur.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/logo.svg">
    <title>Index</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Index.php</h1>
                
                <a class='liens' href="php/creationCompte.php"><img src="svg/addUser.svg" alt="Créer un compte"></a>
                <h4>Création de compte</h4>

                <a class='liens' href="php/deconnexion.php"><img src="svg/logOut.svg" alt="Déconnexion"></a>
                <h4>Déconnexion</h4>

                <a class='liens' href="php/ajouter.php"><img src="svg/addEvent.svg" alt="Ajouter un évènement"></a>
                <h4>Ajout d'évènement</h4>

                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th scope="col">IdEv</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Date</th>
                            <th scope="col">Département</th>
                            <th scope="col">Location</th>
                            <th scope="col">Suppression</th>
                            <th scope="col">Modification</th>
                            <th scope="col">Votes</th>
                            <th scope="col">Afficher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $conn->query('SET NAMES utf8');
                        $sql = "SELECT * FROM event";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["idEv"];
                                echo "<tr>" . " <th scope = 'row'> " . $row["idEv"] . "</th>" . "<td>" . $row["nameEv"] . "</td>" . "<td>" . $row["dateEv"] . "</td>" . "<td>" . $row["departementEv"] . "</td>" . "<td>" . $row["locationEv"] . "</td>" . "<td>" . "<a class='liens' href='php/supprimer.php?id=" . $id . "'><img src='svg/deleteEvent.svg' alt='Supprimer'/></a>" .  "</td> " . "<td>" . "<a class='liens' href='php/modifier.php?id=" . $id . "'><img src='svg/editEvent.svg' alt='Modifier'/></a>" . "</td>" . "<td>" . "<a class='liens' href='php/choisir.php?id=" . $id . "'><img src='svg/vote.svg' alt='Voter'/></a>" .  "</td>" . "<td>" . "<a class='liens' href='php/afficher.php?id=" . $id . "'><img src='svg/showVote.svg' alt='Afficher'/></a>" . "</td>" . "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>