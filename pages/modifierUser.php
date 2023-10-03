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

        $champsErreur = "";
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $id = $_GET['id'];
            $oldImage = "";
            $oldNom = "";
            $oldPrenom = "";
            $oldPoste = "";
            $oldEmail = "";
            $oldMotDePasse = "";
            $oldPin = "";


            $servername  =  "localhost";
            $username  =  "root";
            $password  =  "root";
            $dbname  =  "smileface";

            //  Create  connection
            $conn  =  new  mysqli($servername,  $username,  $password,  $dbname);
            //  Check  connection
            if ($conn->connect_error) {
                die("Connection  failed:  "  .  $conn->connect_error);
            }

            $sql  =  "SELECT * FROM `user` WHERE `idUser` = $id";
            $result  =  $conn->query($sql);
            if ($result->num_rows  >  0) {
                //  output  data  of  each  row
                while ($row  =  $result->fetch_assoc()) {

                    $oldImage = $row["image"];
                    $oldPrenom = $row["firstname"];
                    $oldNom = $row["lastname"];
                    $oldPoste = $row["poste"];
                    $oldEmail = $row["email"];
                    $oldPin = $row["pin"];
                    $oldMotDePasse = $row["password"];
                }
            } else {
                echo  "0  results";
            }
            $conn->close();
        }
        ?>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "POST"; // Debug

            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['poste']) || empty($_POST['email'])) {
                $champsErreur = "Veuillez remplir tout les champs";
                $erreur = true;
            } else {
                $image = test_input($_POST['image']);
                $nom = test_input($_POST['nom']);
                $prenom = test_input($_POST['prenom']);
                $poste = test_input($_POST['poste']);
                $email = test_input($_POST['email']);
                $pin = test_input($_POST['pin']);

                $servername = "localhost";
                $usernameDB = "root";
                $passwordDB = "root";
                $dbname = "smileface";

                $conn2 = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
                if ($conn2->connect_error) {
                    die("Connexion failed: " . $conn2->connect_error);
                }
                $conn2->query('SET NAMES utf8');
                $sql = "UPDATE `user` SET `image` = '$image', `lastname` = '$nom', `firstname` = '$prenom', `poste` = '$poste', `email` = '$email', `pin` = '$pin' WHERE `user`.`idUser` = $idUser";
                echo $sql; // Debug

                if (mysqli_query($conn2, $sql)) {
                    echo '<div class="alert alert-primary" role="alert">
                      Compte créé avec succès.
                  </div>';
                    /*echo '<script>
                      setTimeout(function(){
                          window.location.href = "user.php";
                      }, 3000); // Redirection après 3 secondes (3000 millisecondes)
                  </script>';*/
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn2);
                }
                $conn2->close();
            }
        }

        $conn->close();

        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            echo "Erreur ou 1ere fois";

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
                                        <form class="needs-validation" novalidate id="categoryForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group">
                                                <span class="form-label">Image</span>
                                                <input class="form-control" name="image" value="<?php echo $oldImage ?>" type="text" placeholder="Entrer le lien de l'image" required>
                                                <div class="invalid-feedback">
                                                    Veuillez entrer l'image.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Nom</span>
                                                <input class="form-control" name="nom" type="text" value="<?php echo $oldNom ?>" placeholder="Entrer le nom" required>
                                                <div class="invalid-feedback">
                                                    Veuillez entrer le nom.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Prenom</span>
                                                <input class="form-control" name="prenom" type="text" value="<?php echo $oldPrenom ?>" placeholder="Entrer le prenom" required>
                                                <div class="invalid-feedback">
                                                    Veuillez entrer le prénom.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Poste</span>
                                                <input class="form-control" name="poste" type="text" value="<?php echo $oldPoste ?>" placeholder="Entrer le poste" required>
                                                <div class="invalid-feedback">
                                                    Veuillez entrer le poste.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Email</span>
                                                <input class="form-control" name="email" type="email" value="<?php echo $oldEmail ?>" placeholder="Entrer l'email" required>
                                                <div class="invalid-feedback">
                                                    Veuillez entrer l'email.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">PIN</span>
                                                <input class="form-control" name="pin" type="text" value="<?php echo $oldPin ?>" placeholder="Entrer le code PIN" required>
                                                <div class="invalid-feedback">
                                                    Veuillez entrer le code PIN.
                                                </div>
                                            </div>
                                            <div class="form-btn">
                                                <button class="submit-btn" type="submit">Appliquer les modifications</button>
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
<?php

        }

        function test_input($data)
        {
            $data = trim($data);
            $data = addslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/validation.js"></script>
</body>

</html>