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
    <link rel="stylesheet" href="../css/style_add_form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Ajouter</title>
</head>

<body>
    <?php

    $idUser = $_SESSION['idUser'];
    $nameEv = "";
    $dateEv = "";
    $departementEv = "";
    $locationEv = "";
    $employeurEv = "";
    $descriptionEv = "";
    $time = "";
    $minute =  "";

    $champsErreur = "";
    $erreur = false;
    $tuples = array();

    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "root", "smileface");

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
    }

    // Requête SQL pour récupérer tous les départements
    $sql = "SELECT * FROM departement";
    $result = $mysqli->query($sql);

    // Vérifier si la requête a réussi
    if ($result === false) {
        die("Erreur lors de la récupération des départements : " . $mysqli->error);
    }

    while ($row = $result->fetch_assoc()) {
        $cle = $row['code'];

        $tuple = array(
            $cle => $row['Name']
        );

        $tuples[] = $tuple;
    }

    // Fermez la connexion à la base de données
    $mysqli->close();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";
        if (empty($_POST['eventName']) || empty($_POST['location']) || empty($_POST['departments']) || empty($_POST['eventDate'])) {
            $champsErreur = "Veuillez remplir tous les champs";
            $erreur = true;
        }
        $nameEv = test_input($_POST["eventName"]);
        $dateEv = test_input($_POST["eventDate"]);
        $locationEv = test_input($_POST["location"]);
        $time =  test_input($_POST["eventHour"]);
        $minute =  test_input($_POST["eventMinute"]);
        $employeurEv = test_input($_POST["employeur"]);
        $descriptionEv = test_input($_POST["description"]);
        $timeEv = $time . ":" . $minute;
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "smileface";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $conn->query('SET NAMES utf8');

        date_default_timezone_set('America/New_York');

        $sql = "INSERT INTO `event` (`idEv`, `nameEv`, `dateEv`, `timeEv`, `locationEv`, `employeurEv`, `descriptionEv`, `idUser`) VALUES (NULL, '$nameEv', '$dateEv', '$timeEv', '$locationEv', '$employeurEv', '$descriptionEv', '$idUser')";

        // Exécutez la requête
        if ($conn->query($sql) === true) {
            echo "evenement insérée avec succès.";
        } else {
            echo "Erreur lors de l'insertion du l'evenement : " . $conn->error;
        }

        $selectedDepartements = json_decode($_POST["selectedDepartements"], true);

        // Boucle pour inserer les departements lier a l'evenement qu'on viens de creer en base de donnees
        foreach ($selectedDepartements as $category) {
            echo ($category);

            $idEv = 0;
            $idDpt = 0;

            $sql = "SELECT idEv FROM event ORDER BY idEv DESC LIMIT 1";

            $sqlIdDpt = "SELECT id FROM departement WHERE `Name` = '$category'";

            $result = $conn->query($sql);

            $resultIdDpt = $conn->query($sqlIdDpt);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $idEv = $row['idEv'];
                }
            } else {
                //echo "0 results";
            }

            if ($resultIdDpt->num_rows > 0) {
                while ($row = $resultIdDpt->fetch_assoc()) {

                    $idDpt = $row['id'];
                }
            } else {
                //echo "0 results";
            }

            // Requête SQL pour l'insertion
            $sqlInsertDept = "INSERT INTO liason (id, idEv, idDpt) VALUES (NULL, '$idEv', '$idDpt')";

            // Exécutez la requête
            if ($conn->query($sqlInsertDept) === true) {
                //echo "departement insérée avec succès.";

            } else {
                //echo "Erreur lors de l'insertion du departement : " . $conn->error;

            }
        }

        if (mysqli_query($conn, $sql)) {
            //header("Location: ../index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois";

    ?>
        <div class="container-fluid">
            <div class="row d-flex justify-content-between ">
                <a href="home.php" class="col-md-4 col-sm-5 mt-4 ms-4 d-flex flex-row align-items-center" style="text-decoration: none; color:black;">
                    <img src="../assets/logo.svg" width="55" height="55" alt="logo">
                    <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
                </a>
                <div class="col-md-2 col-sm-4 mt-4 me-4 d-flex justify-content-end">
                    <a href="pages/user.php" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                        <div class="bg-secondary bg-opacity-50 w-100" style="border-radius: 8px; min-height: 10px;">
                            <h5 class="text-dark mx-3 my-3">GG</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <h1 style="padding-left: 0px;" class="text-center mt-5">Ajouter un evenement</h1>
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
                                                <span class="form-label">Nom</span>
                                                <input class="form-control" name="eventName" type="text" placeholder="Entrer le nom de l'evenement">
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Lieu</span>
                                                <input class="form-control" name="location" type="text" placeholder="Entrer le lieu de l'evenement">
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Entreprise</span>
                                                <input class="form-control" name="employeur" type="text" placeholder="Entrer le lieu de l'evenement">
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Description</span>
                                                <input class="form-control" name="description" type="text" placeholder="Entrer le lieu de l'evenement">
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Sélectionner le(s) département(s) concerné(s) :</span>
                                                <select class="form-control" id="categorySelect">
                                                    <option value="" disabled selected hidden>Sélectionnez une departement</option>
                                                    <?php
                                                    // Générez les options de la liste déroulante en utilisant les données des "tuples"
                                                    foreach ($tuples as $nomColonne => $donnees) {
                                                        foreach ($donnees as $valeur) {
                                                            echo "<option value='$valeur'>$valeur</option>";
                                                        }
                                                        echo "</optgroup>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Affichage des departements sélectionnées -->
                                            <div class="form-group">
                                                <div class="selected-departements">
                                                    <!-- Les departements sélectionnées seront affichées ici -->
                                                </div>
                                                <input type="hidden" id="selectedDepartementsInput" name="selectedDepartements" value="">
                                            </div>
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <span class="form-label">Date</span>
                                                        <input class="form-control" name="eventDate" type="date" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <span class="form-label">Heure</span>
                                                                <select class="form-control" name="eventHour">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                    <option>6</option>
                                                                    <option>7</option>
                                                                    <option>8</option>
                                                                    <option>9</option>
                                                                    <option>10</option>
                                                                    <option>11</option>
                                                                    <option>12</option>
                                                                    <option>13</option>
                                                                    <option>14</option>
                                                                    <option>15</option>
                                                                    <option>16</option>
                                                                    <option>17</option>
                                                                    <option>18</option>
                                                                    <option>19</option>
                                                                    <option>20</option>
                                                                    <option>21</option>
                                                                    <option>22</option>
                                                                    <option>23</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <span class="form-label">Minute</span>
                                                                <select class="form-control" name="eventMinute">
                                                                    <option>00</option>
                                                                    <option>05</option>
                                                                    <option>10</option>
                                                                    <option>15</option>
                                                                    <option>20</option>
                                                                    <option>25</option>
                                                                    <option>30</option>
                                                                    <option>35</option>
                                                                    <option>40</option>
                                                                    <option>45</option>
                                                                    <option>50</option>
                                                                    <option>55</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-btn">
                                                <button class="submit-btn" type="submit">Ajouter</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Tableau pour stocker les departements sélectionnées
            let selectedDepartements = [];

            // Fonction pour mettre à jour l'affichage des departements sélectionnées
            function updateSelectedDepartements() {
                $(".selected-departements").empty();
                selectedDepartements.forEach(function(category) {
                    const categoryItem = `
                        <div style="background-color: #082D74; border: none; border-radius: 8px;" class="btn btn-success m-1">
                            ${category}
                            <button type="button" class="btn btn-danger btn-sm ms-1" data-category="${category}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    $(".selected-departements").append(categoryItem);
                });

                // Lorsqu'on clique sur l'icône de suppression
                $(".selected-departements .btn-danger").click(function() {
                    const categoryToRemove = $(this).data("category");
                    const index = selectedDepartements.indexOf(categoryToRemove);
                    if (index !== -1) {
                        selectedDepartements.splice(index, 1);
                        updateSelectedDepartements();
                    }
                });

                console.log(JSON.stringify(selectedDepartements));

                $("#selectedDepartementsInput").val(JSON.stringify(selectedDepartements));
            }

            // Lorsqu'une departement est sélectionnée dans la liste déroulante
            $("#categorySelect").change(function() {
                const selectedCategory = $(this).val();
                if (selectedCategory.trim() !== "") {
                    // Vérifier si la departement n'est pas déjà dans la liste
                    if (!selectedDepartements.includes(selectedCategory)) {
                        selectedDepartements.push(selectedCategory);
                        updateSelectedDepartements();
                        $(this).val(""); // Réinitialise la liste déroulante
                    } else {
                        alert("Cette departement est déjà sélectionnée.");
                    }
                }
            });
        });
    </script>
</body>

</html>