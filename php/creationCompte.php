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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../assets/logo.svg">
    <title>Création de compte</title>
</head>

<body>
    <?php
    $champsErreur = "";
    $firstname = $lastname = $email = $password = "";
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST"; //Debug

        if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['password']) || empty($_POST['email'])) {
            $champsErreur = "Veuillez remplir tout les champs";
            $erreur = true;
        } else {
            $lastname = test_input($_POST['lastname']);
            $firstname = test_input($_POST['firstname']);
            $email = test_input($_POST['email']);
            $password = test_input($_POST['password']);

            $password = sha1($password, false);

            $servername = "localhost";
            $usernameDB = "root";
            $passwordDB = "root";
            $dbname = "bdsmileyface";

            $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
            if ($conn->connect_error) {
                die("Connexion failed: " . $conn->connect_error);
            }
            $conn->query('SET NAMES utf8');
            $sql = "INSERT INTO user(idUser, lastname, firstname, email, password) VALUES(null,'$lastname','$firstname','$email','$password')";
            echo $sql; //Debug

            if (mysqli_query($conn, $sql)) {
                echo "Compte créé.";
                header("Location: ../index.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            $conn->close();
        }
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois"; //Debug
    ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="validationCustom01" name="lastname" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre nom.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="validationCustom02" name="firstname" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre prénom.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustomUsername" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" class="form-control" id="validationCustom03 aria-describedby=" inputGroupPrepend" name="email" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre adresse courriel.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="validationCustom04" name="password" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre mot de passe.
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Créer</button>
                        </div>
                    </form>
                    <span><?php echo $champsErreur; ?></span>
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
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="../js/validation.js"></script>
</body>

</html>