<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Création de compte</title>
</head>

<body>
    <?php
    $champsErreur = "";
    $nom = $prenom = $email = $password = "";
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";

        if (empty($_POST['user']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['ip']) || empty($_POST['machine'])) {
            $champsErreur = "Veuillez remplir tout les champs";
            $erreur = true;
        }

        $user = test_input($_POST['user']);
        $password = test_input($_POST['password']);
        $email = test_input($_POST['email']);
        $ip = test_input($_POST['ip']);
        $machine = test_input($_POST['machine']);

        $password = sha1($password, false);

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "root";
        $dbname = "vehicule";

        $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
        if ($conn->connect_error) {
            die("Connexion failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO usagers (user, email, password, ip, machine) VALUES ('$user', '$email', '$password','$ip', '$machine')";
        echo $sql;

        if (mysqli_query($conn, $sql)) {
            echo "Compte créé!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        header("Location: index.php");
        $conn->close();
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois";
    ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustomUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">City</label>
                            <input type="text" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom04" class="form-label">State</label>
                            <select class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Choose...</option>
                                <option>...</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom05" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
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
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="js/validation.js"></script>
</body>

</html>