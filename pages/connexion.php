<?php
session_start();



$champsErreur = $invalide = "";
$email = $password = "";
$erreur = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $dbname = "smileface";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
    if ($conn->connect_error) {
        die("Connexion failed: " . $conn->connect_error);
    }
    $conn->query('SET NAMES utf8');
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    //$sql = "SELECT * FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['connexion'] = true;
        $_SESSION['idUser'] = $row['idUser'];
        header("Location: ../index.php");
        exit(); // Assurez-vous de sortir du script après la redirection
    } else {
        $invalide = "Email ou mot de passe invalide.";
        $erreur = true;
       //var_dump($result);
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_form_login.css">
    <title>Connexion</title>
</head>

<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="70" height="70" alt="logo">
                <h1 class="ms-5 fw-bold ">Cegep Tr</h1>
            </div>
        </div>

        <div class="row mt-5">

            <img src="../assets/logo.svg" width="150" height="150" alt="logo">
            <h1 style="padding-left: 0px;" class="text-center mt-3">Bienvenue !</h1>

        </div>

        <div class="row">
            <div id="booking" class="section">
                <div class="section-center">
                    <div class="container">
                        <div class="row">
                            <div class="booking-form">
                                <form class="needs-validation" novalidate method="POST">
                                    <div class="form-group">
                                        <span class="form-label">Email</span>
                                        <input class="form-control" type="text" name="email" placeholder="Entrer votre email" required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer l'email.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label">Mot de passe</span>
                                        <input class="form-control" type="password" name="password" placeholder="Entrer votre mot de passe" required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer le mot de passe.
                                        </div>
                                    </div>

                                    <div class="form-btn">
                                        <button class="submit-btn">Connexion</button>
                                    </div>
                                </form>
                                
                                <?php if ($erreur) : ?>
                                    <div class="alert alert-danger mt-3">
                                        Nom d'utilisateur ou mot de passe incorrect.
                                    </div>
                                <?php endif; ?>
                                <!-- <span style="color:red" ;><?php echo $champsErreur; ?></span><br>
                                <span style="color:red" ;><?php echo $invalide; ?></span><br> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="../js/validation.js"></script>
</body>

</html>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>