<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: php/connexion.php");
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
    <title>Modifier</title>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo "Erreur";
    }
    $nameEv = $dateEv = $departementEv = $locationEv = "";

    $idUser = 0;
    $idUser = $_SESSION['idUser'];

    $champsErreur = "";

    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";

        if (empty($_POST['nameEv']) || empty($_POST['dateEv']) || empty($_POST['departementEv']) || empty($_POST['locationEv'])) {
            $champsErreur = "Veuillez remplir tout les champs";
            $erreur = true;
        }
        $nameEv = test_input($_POST["nameEv"]);
        $dateEv = test_input($_POST["dateEv"]);
        $departementEv = test_input($_POST["departementEv"]);
        $locationEv = test_input($_POST["locationEv"]);

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "bdsmileyface";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "<b>Connected successfully</b>";
        $conn->query('SET NAMES utf8');
        $sql = "UPDATE event SET nameEv='$nameEv', dateEv='$dateEv', departementEv='$departementEv', locationEv='$locationEv' WHERE idEv=$id";

        if ($conn->query($sql) == TRUE) {
            echo "Record updated successfully";
            header("Location: ../index.php");
        } else {
            echo "Error updatting record" . $conn->error;
        }
        $conn->close();
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois";
        $sqlsauv = "SELECT * FROM event WHERE idEv=$id";
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "bdsmileyface";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query($sqlsauv);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nameEv = $row["nameEv"];
            $dateEv = $row["dateEv"];
            $departementEv = $row["departementEv"];
            $locationEv = $row["locationEv"];
            echo $locationEv;
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-xl-12">
                    <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo  $id  ?>">
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Nom de l'évènement</label>
                            <input type="text" class="form-control" id="validationCustom01" name="nameEv" value="<?php echo $nameEv ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le nom de l'évènement.
                            </div>
                        </div>
                        <div class="col-md-6 date-input">
                            <label for="validationCustom02" class="form-label">Date de l'évènement (Format = AAAA-MM-JJ)</label>
                            <input type="date" class="form-control" id="validationCustom02" name="dateEv" value="<?php echo $dateEv ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer la date de l'évènement
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Département de l'évènement</label>
                            <input type="text" class="form-control" id="validationCustom03" name="departementEv" value="<?php echo $departementEv ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le département de l'évènement.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Location de l'évènement</label>
                            <input type="text" class="form-control" id="validationCustom04" name="locationEv" value="<?php echo $locationEv ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer la location dans laquelle l'évènement va prendre place.
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Modifier l'évènement</button>
                            <span style="color:red" ;><?php echo $champsErreur; ?></span><br>
                        </div>
                    </form>
                    <a href="../index.php">Annulé</a>
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
    <script src="../js/validation.js"></script>
</body>

</html>