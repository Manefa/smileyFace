<!-- Copié -> a changer.-->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>

<body>
    <?php
        $champsErreur = "";
        $user = $password = "";
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";

        if (empty($_POST['user']) || empty($_POST['password'])) {
            $champsErreur = "Veuillez remplir tout les champs";
            $erreur = true;
        }

        $user = test_input($_POST['user']);
        $password = test_input($_POST['password']);

        $password = sha1($password, false);

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "root";
        $dbname = "vehicule";

        $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
        if ($conn->connect_error) {
            die("Connexion failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usagers WHERE user='$user' AND password='$password'";
        echo $sql;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>Connecté</h1>";
            $_SESSION['connexion'] = true;
            header("Location: index.php");
        } else {
            echo "<h1>Nom d'usager ou mot de passe invalide</h1>";
        }
        $conn->close();
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            echo "Erreur ou 1ere fois";
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <a href="index.php">test</a>
                    <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="validationCustom01" name="user" required placeholder="Ex: TimHenson623">
                            <div class="invalid-feedback">
                                Veuillez entrer votre nom d'utilisteur.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="validationCustom02" name="password" required placeholder="Ex: password (pas une bonne idée)">
                            <div class="invalid-feedback">
                                Veuillez entrer votre mot de passe.
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Connexion</button>
                            <span style="color:red" ;><?php echo $champsErreur; ?></span><br>
                        </div>
                    </form>
                    <button class="btn btn-secondary" id="btnCreer"><a href="creation.php" class="liens">Créer un compte</a></button>
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

                <script src="validation.js"></script>
                </div>
            </div>
        </div>
</body>

</html>