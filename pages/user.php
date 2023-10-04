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

    <!-- Inclure ici vos propres fichiers CSS et JavaScript pour personnalisation -->
</head>

<body>

    <div class="container-fluid">

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
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $image ?>" class="card-img-top" alt="Photo de profil">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fullname ?></h5>
                            <p class="card-text"><?php echo $poste ?></p>
                            <a href="../pages/modifierUser.php?id=<?php echo $idUser ?>" class="btn btn-warning mt-2">Modifier mon profil</a>
                            <a href="../pages/ajouterUser.php" class="btn btn-info mt-2">Ajouter un autre utilisateur</a>
                            <a href="#" class="btn btn-success mt-2">Ajouter un département</a>
                            <a href="#" class="btn btn-primary mt-2">Créer un événement</a>
                            <a href="#" class="btn btn-danger mt-2">Supprimer un département</a>

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

                <div class="col-md-4">
                    <h2>Liste d'autres utilisateurs</h2>
                    <div class="row">
                        <?php

                         // Récupérez la liste des autres utilisateurs (à l'exception de l'utilisateur actuel)
                         $servername = "localhost";
                         $username = "root";
                         $password = "root";
                         $db = "smileface";
 
                         $conn = new mysqli($servername, $username, $password, $db);
 
                         if ($conn->connect_error) {
                             die("Connection failed: " . $conn->connect_error);
                         }

                         
                        // Récupérez la liste des autres utilisateurs (à l'exception de l'utilisateur actuel)
                        $sqlUsers = "SELECT * FROM `user` WHERE `idUser` != $idUser";
                        $resultUsers = $conn->query($sqlUsers);

                        if ($resultUsers->num_rows > 0) {
                            while ($row = $resultUsers->fetch_assoc()) {
                                $otherUserId = $row['idUser'];
                                $otherFirstname = $row['firstname'];
                                $otherLastname = $row['lastname'];
                                $otherImage = $row['image'];
                                $otherPoste = $row['poste'];

                                // Construisez la carte Bootstrap pour chaque utilisateur
                                echo '<div class="col-md-6 mb-4">
                        <div class="card">
                            <img src="' . $otherImage . '" class="card-img-top" alt="Photo de profil">
                            <div class="card-body ">
                                <h5 class="card-title">' . ucfirst($otherFirstname) . ' ' . ucfirst($otherLastname) . '</h5>
                                <p class="card-text">' . $otherPoste . '</p>
                                <a href="userless.php?id='.$otherUserId .'" class="btn btn-primary" >
                                    <i class="fas fa-eye"></i> Afficher
                                </a>
                                <a href="modifierUser.php?id=' . $otherUserId . '" class="btn btn-warning mt-1">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="../php/supprimerUser.php?id='. $otherUserId. '"class="btn btn-danger mt-1">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </div>
                        </div>
                    </div>';
                            }
                        } else {
                            echo 'Aucun autre utilisateur trouvé.';
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure ici vos propres fichiers JavaScript pour l'interaction -->
</body>

</html>