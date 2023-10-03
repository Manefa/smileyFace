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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "smileface";

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $idUser = $_SESSION['idUser'];
    $idEv = $_GET['idEv'];
    $firstname = "";
    $lastname = "";
    $pseudo = "";
    $nomEv = "";
    $dateEv = "";
    $locationEv = "";
    $employeurEv = "";
    $departementsEv = array();
    $descriptionEv = "";

    $sqlEvent = "SELECT * FROM `event` WHERE `idEv` = $idEv";
    $resultEvent = $conn->query($sqlEvent);

    if ($resultEvent->num_rows > 0) {
        while ($row = $resultEvent->fetch_assoc()) {
            $nomEv = $row['nameEv'];
            $dateEv = $row['dateEv'];
            $locationEv = $row['locationEv'];
            $employeurEv = $row['employeurEv'];
            $descriptionEv = $row['descriptionEv'];
        }
    } else {
        echo "0 results";
    }

    $sqlUser = "SELECT * FROM `user` WHERE `idUser` = $idUser";
    $resultUser = $conn->query($sqlUser);

    if ($resultUser->num_rows > 0) {
        while ($row = $resultUser->fetch_assoc()) {
            $lastname = $row['lastname'];
            $firstname = $row['firstname'];
        }
    } else {
        //echo "0 results";
    }

    // Fonction pour récupérer le nombre de votes pour chaque catégorie (aimer, neutre, détester)
    function getVoteCounts($table)
    {
        $sql = "SELECT 
                SUM(CASE WHEN satisfactionlevelEm = 1 THEN 1 ELSE 0 END) AS aimer,
                SUM(CASE WHEN satisfactionlevelEm = 2 THEN 1 ELSE 0 END) AS neutre,
                SUM(CASE WHEN satisfactionlevelEm = 3 THEN 1 ELSE 0 END) AS detester
            FROM $table";

        $result = mysqli_query($GLOBALS['conn'], $sql);

        if (!$result) {
            die("Erreur de requête : " . mysqli_error($GLOBALS['conn']));
        }

        return mysqli_fetch_assoc($result);
    }

    function getVoteCountsEt($table)
    {
        $sql = "SELECT 
                SUM(CASE WHEN satisfactionlevelEt = 1 THEN 1 ELSE 0 END) AS aimer,
                SUM(CASE WHEN satisfactionlevelEt = 2 THEN 1 ELSE 0 END) AS neutre,
                SUM(CASE WHEN satisfactionlevelEt = 3 THEN 1 ELSE 0 END) AS detester
            FROM $table";

        $result = mysqli_query($GLOBALS['conn'], $sql);

        if (!$result) {
            die("Erreur de requête : " . mysqli_error($GLOBALS['conn']));
        }

        return mysqli_fetch_assoc($result);
    }

    // Récupération des votes pour la table employeesatisfaction
    $employeeSatisfactionCounts = getVoteCounts('employeesatisfaction');
    $studentSatisfactionCounts = getVoteCountsEt('studentsatisfaction');

    $employeeSatisfactionJSON = json_encode($employeeSatisfactionCounts);
    $studentSatisfactionJSON = json_encode($studentSatisfactionCounts);

    $pseudo = strtoupper(substr($firstname, 0, 1)) . strtoupper(substr($lastname, 0, 1));

    $fullname = ucfirst($firstname) . " " . ucfirst($lastname);

    // Requête SQL pour récupérer les noms des départements liés à l'événement
    $sqlDpt = "SELECT d.Name
    FROM liason l
    INNER JOIN departement d ON l.idDpt = d.id
    WHERE l.idEv = $idEv";

    $resultDpt = mysqli_query($conn, $sqlDpt);

    if (!$resultDpt) {
        die("Erreur de requête : " . mysqli_error($conn));
    }

    // Créer un tableau pour stocker les noms des départements
    $departements = array();

    // Récupérer les noms des départements et les ajouter au tableau
    while ($row = mysqli_fetch_assoc($resultDpt)) {
        $departements[] = $row['Name'];
    }

    mysqli_close($conn);

    ?>

    <div class="container-fluid">

        <div class="row justify-content-between g-0">
            <div class="col-md-4 col-sm-5 mt-4 ms-2 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="55" height="55" alt="logo">
                <h1 class="ms-4 fw-bold">Cegep 3R</h1>
            </div>

            <div class="col-md-3 col-sm-4 mt-4 me-2 d-flex justify-content-end">
                <a href="#" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                    <div class=" w-100" style="border-radius: 8px; min-height: 10px;  background-color:#082D74;">
                        <h5 class="text-light mx-3 my-3"><?php echo $pseudo ?> </h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-5 ms-2 me-2">
            <div class="col-md-4">
                <h1><?php echo $nomEv ?></h1>
                <p>Date de l'événement : <?php echo $dateEv ?></p>
                <p>Lieu de l'événement : <?php echo $locationEv ?></p>
                <p>Employeur concerné : <?php echo $employeurEv ?></p>
                <?php
                
                if (count($departements) > 0) {
                    
                    $departementsListe = implode(', ', $departements);

                    
                    echo "<p>Départements concernés : $departementsListe</p>";
                } else {
                    
                    echo "<p>Aucun département concerné.</p>";
                }
                ?>
                <p>Description de l'événement : <?php echo $descriptionEv ?></p>
                <?php
                date_default_timezone_set('America/New_York');
                $date_evenement = strtotime($row['dateEv']);
                $aujourd_hui = time();
                if ($date_evenement < $aujourd_hui) {
                    echo "<a href='#' class='btn btn-primary'>Lancer le vote</a>";
                }
                ?>

            </div>
            <div class="col-md-4">
                <!-- Graphique des statistiques -->
                <canvas id="statsChart">

                </canvas>

            </div>
            <div class="col-md-4">
                <!-- Graphique des statistiques -->
                <canvas id="statshartSecond" aria-label="Hello ARIA World" role="img">
                    <p>Hello Fallback World</p>
                </canvas>

            </div>
        </div>
    </div>


    <script>
        var employeeSatisfactionData = <?php echo $employeeSatisfactionJSON; ?>;
        var studentSatisfactionData = <?php echo $studentSatisfactionJSON; ?>;

        // graphique
        var ctx = document.getElementById('statsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Aimé', 'Neutre', 'Pas aimé'],
                datasets: [{
                    data: [employeeSatisfactionData.aimer, employeeSatisfactionData.neutre, employeeSatisfactionData.detester],
                    backgroundColor: ['#28a745', '#6c757d', '#dc3545'],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistiques concernant les votes des employeurs',
                    },
                },
                legend: {
                    position: 'bottom',
                },

            },
        });

        var ctxsecond = document.getElementById('statshartSecond').getContext('2d');
        var myChartSecond = new Chart(ctxsecond, {
            type: 'doughnut',
            data: {
                labels: ['Aimé', 'Neutre', 'Pas aimé'],
                datasets: [{
                    data: [studentSatisfactionData.aimer, studentSatisfactionData.neutre, studentSatisfactionData.detester],
                    backgroundColor: ['#28a745', '#6c757d', '#dc3545'],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistiques concernant les votes des etudiants',
                    },
                },
                legend: {
                    position: 'bottom',
                },

            },
        });
    </script>

</body>

</html>