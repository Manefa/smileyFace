<!-- Copié -> a changer.-->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Connexion</title>
</head>

<body>
    <?php
    $champsErreur = $invalide = "";
    $email = $password = "";
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";

        if (empty($_POST['email']) || empty($_POST['password'])) {
            $champsErreur = "Veuillez remplir tout les champs";
            $erreur = true;
        }

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

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        echo $sql;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>Connecté</h1>";
            $_SESSION['connexion'] = true;
            header("Location: ../index.php");
        } else {
            echo "<h1>Nom d'usager ou mot de passe invalide</h1>"; //Debug
            $invalide = "Email ou mot de passe invalide.";
            $erreur = true;
            header("Location: connexion.php");
        }
        $conn->close();
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois"; //Debug
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Email</label>
                            <input type="email" class="form-control" id="validationCustom01" name="email" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre adresse courriel.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="validationCustom02" name="password" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre mot de passe.
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Connexion</button>
                            <span style="color:red" ;><?php echo $champsErreur; ?></span><br>
                            <span style="color:red" ;><?php echo $invalide; ?></span><br>
                        </div>
                    </form>
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

                <script src="../js/validation.js"></script>
                </div>
            </div>
        </div>
</body>

</html>