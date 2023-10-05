<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: pages/connexion.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Inclure ici vos propres fichiers CSS et JavaScript pour personnalisation -->
</head>

<body>

    <div class="container-fluid">

        <?php

        $idUser = $_GET["id"];
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "smileface";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $firstname = "";
        $lastname = "";
        $pseudo = "";
        $image = "";
        $poste = "";

        $sqlUser = "SELECT * FROM `user` WHERE `idUser` = $idUser";
        $resultUser = $conn->query($sqlUser);

        if ($resultUser->num_rows > 0) {
            while ($row = $resultUser->fetch_assoc()) {
                $lastname = $row['lastname'];
                $firstname = $row['firstname'];
                $image = $row['image'];
                $poste = $row['poste'];
            }
        } else {
            //echo "0 results";
        }

        $pseudo = strtoupper(substr($firstname, 0, 1)) . strtoupper(substr($lastname, 0, 1));

        $fullname = ucfirst($firstname) . " " . ucfirst($lastname);

        // evenement creer par cette utilisateur 

        $sql = "SELECT * FROM `event` WHERE `idUser` = $idUser";
        $result = $conn->query($sql);
        $evenements = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $evenement = [
                    'idEv' => $row['idEv'],
                    'nom' => $row['nameEv'],
                ];

                array_push($evenements, $evenement);
            }
        } else {
            //echo "0 results";
        }

        $conn->close();

        ?>
        <div class="row justify-content-between g-0">
            <a href="../index.php" class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center" style="text-decoration: none; color:black;">
                <img src="../assets/logo.svg" width="55" height="55" alt="logo">
                <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
            </a>

            <div class="col-md-3 col-sm-4 mt-4 me-2 d-flex justify-content-end">
                <a href="#" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                    <div class=" w-100" style="border-radius: 8px; min-height: 10px;  background-color:#082D74;">
                        <h5 class="text-light mx-3 my-3"><?php echo $pseudo ?> </h5>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $image ?>" class="card-img-top" alt="Photo de profil">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fullname ?></h5>
                            <p class="card-text"><?php echo $poste ?></p>
                            <a href="../pages/modifierUser.php?id=<?php echo $idUser ?>" class="btn btn-warning mt-2"><i style="color: white" class="bi bi-pencil-square"></i></a>
                            <a href="../pages/supprimerUser.php?id=<?php echo $idUser ?>" class="btn btn-danger mt-2"><i style="color: white" class="bi bi-trash"></i></a>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h2>Liste d'événements créés par l'utilisateur</h2>
                    <ul class="list-group mt-4">
                        <?php
                        foreach ($evenements as $evenement) {
                            echo '<a style="text-decoration: none; color: black;"; href="../pages/evenement.php?idEv=' . $evenement['idEv'] . '"><li class="list-group-item">' . $evenement['nom'] . '</li></a>';
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure ici vos propres fichiers JavaScript pour l'interaction -->
</body>

</html>