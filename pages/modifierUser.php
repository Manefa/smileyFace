<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_add_form.css">
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

        $conn->close();

        ?>
        <div class="row justify-content-between g-0">
            <div class="col-md-4 col-sm-5 mt-4 ms-2 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="55" height="55" alt="logo">
                <h1 class="ms-4 fw-bold">Cegep 3R</h1>
            </div>

            <div class="col-md-3 col-sm-4 mt-4 me-2 d-flex justify-content-end">
                <a href="#" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                    <div class=" w-100" style="border-radius: 8px; min-height: 10px; background-color:#082D74;">
                        <h5 class="text-light mx-3 my-3"><?php echo $pseudo ?> </h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="row text-center">
            <h1 class="fw-bold">Modification des informations</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="booking" class="section">
                    <div class="section-center">
                        <div class="container">
                            <div class="row">
                                <div class="booking-form">
                                    <form id="categoryForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="form-group">
                                            <span class="form-label">Image</span>
                                            <input class="form-control" name="image" type="text" placeholder="Entrer le lien de l'image">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">Nom</span>
                                            <input class="form-control" name="nom" type="text" placeholder="Entrer le nom">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">Prenom</span>
                                            <input class="form-control" name="prenom" type="text" placeholder="Entrer le prenom">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">Poste</span>
                                            <input class="form-control" name="poste" type="text" placeholder="Entrer le poste">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">Email</span>
                                            <input class="form-control" name="email" type="email" placeholder="Entrer l'email">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">Mot de passe</span>
                                            <input class="form-control" name="motdepasse" type="password" placeholder="Entrer le mot de passe">
                                        </div>
                                        <div class="form-group">
                                            <span class="form-label">PIN</span>
                                            <input class="form-control" name="pin" type="text" placeholder="Entrer le code PIN">
                                        </div>
                                        <div class="form-btn">
                                            <button class="submit-btn" type="submit">Modifier l'utilisateur</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>