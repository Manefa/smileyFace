<?php 
session_start();
if($_SESSION['connexion'] == false) {
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
        $sql = "UPDATE event SET marque='$marque', modele='$modele', prix=$prix, url='$url' WHERE id=$id";

        if ($conn->query($sql) == TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updatting record" . $conn->error;
        }
        header("Location: ../index.php");
        $conn->close();
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois";
        $sqlsauv = "SELECT * FROM voiture WHERE id=$id";
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "vehicule";
    
        $conn = new mysqli($servername, $username, $password, $db);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $result = $conn->query($sqlsauv);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $marque = $row["marque"];
            $modele = $row["modele"];
            $prix = $row["prix"];
            $url = $row["url"];
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
                            <label for="validationCustom01" class="form-label">Marque</label>
                            <input type="text" class="form-control" id="validationCustom01" value="<?php echo $marque ?>" name="marque" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une marque de voiture.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Modèle</label>
                            <input type="text" class="form-control" id="validationCustom02" name="modele" value="<?php echo $modele ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un modèle de voiture qui correspond à la marque.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Prix</label>
                            <input type="number" class="form-control" id="validationCustom03" name="prix" value="<?php echo $prix ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le prix à l'affichage de la voiture.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">URL</label>
                            <input type="text" class="form-control" id="validationCustom04" name="url" value="<?php echo $url ?>" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un URL qui pointe vers l'image de cette voiture.
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Confirmer</button>
                            <span style="color:red" ;><?php echo $champsErreur; ?></span><br>
                        </div>
                    </form>
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
    <script src="validation.js"></script>
</body>

</html>