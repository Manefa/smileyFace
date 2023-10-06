<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}

require("../php/localserver.php");

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
    <title>Modifier</title>
</head>

<body>
    <?php
    $idUser = $_SESSION['idUser'];
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $idEvGet =  $_GET['id'];

        $oldIdEv = "";
        $oldNameEv = "";
        $oldDateEv = "";
        $oldDepartementEv = "";
        $oldLocationEv = "";
        $oldTime = "";
        $oldMinute =  "";
        $oldPeriod = "";

        $tuples = array();
        $idDptLierEv = array();
        $nomsDepartementLier = array();

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "root", "smileface");

        // Vérifier la connexion
        if ($mysqli->connect_error) {
            die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
        }

        //var_dump($idEvGet);

        // Requête SQL pour récupérer tous les départements lier a un evenement dans la table liason
        $sqlDpt = "SELECT * FROM `liason` WHERE `idEv` = '$idEvGet'";
        $resultDpt = $mysqli->query($sqlDpt);

        while ($row = $resultDpt->fetch_assoc()) {
            $idDptLierEv[] = $row['idDpt'];
        }

        foreach ($idDptLierEv as $dptId) {
            // Requête SQL pour récupérer le nom de l'événement en fonction de l'ID
            $sqlNomDpt = "SELECT Name FROM `departement` WHERE `id` = $dptId";
            $resultNomDpt = $mysqli->query($sqlNomDpt);

            // Vérifier si la requête a réussi
            if ($resultNomDpt === false) {
                die("Erreur lors de la récupération du nom du departement : " . $mysqli->error);
            }

            // recuperation du nom du departement
            if ($row = $resultNomDpt->fetch_assoc()) {
                $nomsDepartementLier[$dptId] = $row['Name']; // Stocke du nom dans le tableau 
            }
        }

        /*var_dump($nomsDepartementLier);

        $nomDepartemetsLierPourConv = array();

        for($i = 0; i < count($nomsDepartementLier); $i++){
          $school[0]["name"]
        }

        foreach($nomDepartemetsLier as $value){
          $nomDepartemetsLierPourConv = $value
        }


        // Convertir juste les nom de departements sélectionnés en JSON
        $selectedDepartmentsNameJson = json_encode($nomsDepartementLier);*/

        // Convertir les données des départements sélectionnés en JSON
        $selectedDepartmentsJson = json_encode($nomsDepartementLier);


        // Requête SQL pour récupérer tous les départements
        $sql = "SELECT * FROM departement";
        $result = $mysqli->query($sql);

        // Requête SQL pour récupérer tous les départements

        $sqlEvent = "SELECT * FROM `event` WHERE `idEv` = $idEvGet";
        $resultEvent = $mysqli->query($sqlEvent);

        // Vérifier si la requête a réussi
        if ($result === false) {
            die("Erreur lors de la récupération des départements : " . $mysqli->error);
        }

        // Vérifier si la requête a réussi
        if ($resultEvent === false) {
            die("Erreur lors de la récupération de l'evenement : " . $mysqli->error);
        }

        if ($resultDpt === false) {
            die("Erreur lors de la récupération des partements lier a l'evenement : " . $mysqli->error);
        }

        // recuperation des ionformations de tous les departements dans un tuples

        while ($row = $result->fetch_assoc()) {
            $cle = $row['code'];

            $tuple = array(
                $cle => $row['Name']
            );

            $tuples[] = $tuple;
        }

        //ajout des informations de l'evenement dans les variables

        while ($row = $resultEvent->fetch_assoc()) {
            $oldIdEv =  $row['idEv'];
            $oldNameEv = $row['nameEv'];
            $oldDateEv = $row['dateEv'];
            $oldLocationEv = $row['locationEv'];
            $splitTime = explode(":",$row['timeEv'], 3);

            //var_dump($splitTime);

            $oldTime = trim($splitTime[0]);
            $oldMinute =  trim($splitTime[1]);
        }

        // Fermez la connexion à la base de données
        $mysqli->close();
    }


    $nameEv = "";
    $dateEv = "";
    $departementEv = "";
    $locationEv = "";
    $time = "";
    $minute =  "";
    $period = "";
    $idEvPost = "";

    $champsErreur = "";
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //echo "POST";
        if (empty($_POST['eventName']) || empty($_POST['location']) || empty($_POST['departments']) || empty($_POST['eventDate'])) {
            $champsErreur = "Veuillez remplir tous les champs";
            $erreur = true;
        }

        $idPost = test_input($_POST["idPost"]);
        $nameEv = test_input($_POST["eventName"]);
        $dateEv = test_input($_POST["eventDate"]);
        $locationEv = test_input($_POST["location"]);
        $time =  test_input($_POST["eventHour"]);
        $minute =  test_input($_POST["eventMinute"]);
        $timeEv = $time . ":" . $minute . " " . $period;
        /* $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "smileface";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } */

        $conn->query('SET NAMES utf8');

        date_default_timezone_set('America/New_York');

        //var_dump($idPost);

        $sql = "UPDATE `event` SET `nameEv` = '$nameEv', `dateEv` = '$dateEv', `timeEv` = '$timeEv', `locationEv` = '$locationEv' WHERE `event`.`idEv` = '$idPost'";

        // Exécutez la requête
        if ($conn->query($sql) === true) {
            echo "evenement modifier avec succès.";
        } else {
            echo "Erreur lors de l'insertion du l'evenement : " . $conn->error;
        }



        $existingDepartments = array();
        $selectedDepartments = array();

        // recuperation de la liste de departements lier a cette evenement depuis la base de donnee
        $sqlExistingDepartments = "SELECT d.Name FROM liason AS l
                           INNER JOIN departement AS d ON l.idDpt = d.id
                           WHERE l.idEv = '$idPost'";

        $resultExistingDepartments = $conn->query($sqlExistingDepartments);

        if ($resultExistingDepartments->num_rows > 0) {
            while ($row = $resultExistingDepartments->fetch_assoc()) {
                $existingDepartments[] = $row["Name"];
            }
        }

        // Récupérer la liste des départements sélectionnés depuis le formulaire POST
        if (isset($_POST["selectedDepartements"])) {
            unset($selectedDepartments[1]);
            $selectedDepartments = json_decode($_POST["selectedDepartements"], true);
        } else {
            $selectedDepartments = array();
        }

        //var_dump($selectedDepartments);
        //var_dump($existingDepartments);

        if ($selectedDepartments != null && $existingDepartments != null) {

            // Comparer les départements sélectionnés avec les départements existants en base de données
            if (array_diff($selectedDepartments, $existingDepartments) || array_diff($existingDepartments, $selectedDepartments)) {
                // Les listes sont différentes, l'utilisateur a modifié les départements sélectionnés
                $departementsModifies = true;
            } else {
                // Les listes sont identiques, l'utilisateur n'a pas modifié les départements sélectionnés
                $departementsModifies = false;
            }

            if ($departementsModifies) {

                /*$selectedDepartements = json_decode($_POST["selectedDepartements"], true);

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
            }*/
                
                $selectedDepartmentIDs = array();

                foreach ($selectedDepartments as $selectedDepartment) {
                    $sqlGetDepartmentID = "SELECT id FROM departement WHERE Name = '$selectedDepartment'";
                    $resultGetDepartmentID = $conn->query($sqlGetDepartmentID);

                    if ($resultGetDepartmentID->num_rows > 0) {
                        while ($row = $resultGetDepartmentID->fetch_assoc()) {
                            $selectedDepartmentIDs[] = $row["id"];
                        }
                    }
                }

                
                $existingDepartmentIDs = array();
                $sqlExistingDepartments = "SELECT idDpt FROM liason WHERE idEv = '$idPost'";
                $resultExistingDepartments = $conn->query($sqlExistingDepartments);

                if ($resultExistingDepartments->num_rows > 0) {
                    while ($row = $resultExistingDepartments->fetch_assoc()) {
                        $existingDepartmentIDs[] = $row["idDpt"];
                    }
                }

                
                foreach ($selectedDepartmentIDs as $selectedDepartmentID) {
                    
                    if (!in_array($selectedDepartmentID, $existingDepartmentIDs)) {
                        $sqlInsertDept = "INSERT INTO liason (id, idEv, idDpt) VALUES (NULL, '$idPost', '$selectedDepartmentID')";
                        $conn->query($sqlInsertDept);
                    }
                }

                foreach ($existingDepartmentIDs as $existingDepartmentID) {
                    
                    if (!in_array($existingDepartmentID, $selectedDepartmentIDs)) {
                        $sqlDeleteDept = "DELETE FROM liason WHERE idEv = '$idPost' AND idDpt = '$existingDepartmentID'";
                        $conn->query($sqlDeleteDept);
                    }
                }
            } else {
            }
        }

        if (mysqli_query($conn, $sql)) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        //echo "Erreur ou 1ere fois";

    ?>
        <div class="container-fluid">
            <div class="row d-flex justify-content-between ">
                <a href="../index.php" class="col-md-4 mt-4 ms-2 d-flex flex-row align-items-center" style="text-decoration: none; color:black;">
                    <img src="../assets/logo.svg" width="55" height="55" alt="logo">
                    <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
                </a>

                <div class="col-md-2 mt-4 me-4 d-flex justify-content-end">
                    <a href="home.php" class="d-flex flex-row align-items-center justify-content-end " style="text-decoration: none;">
                        <div class="bg-secondary bg-opacity-50" style="border-radius: 8px;">
                            <h3 class="text-dark mx-3 my-3">MY</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <h1 style="padding-left: 0px;" class="text-center mt-5">Modifier l'evenement</h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="booking" class="section">
                        <div class="section-center">
                            <div class="container">
                                <div class="row">
                                    <div class="booking-form">
                                        <form id="categoryForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control" id="id" aria-describedby="imageHelp" name="idPost" value="<?php echo $oldIdEv; ?>">

                                                <br>
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Nom</span>
                                                <input class="form-control" name="eventName" type="text" value="<?php echo $oldNameEv; ?>" placeholder="Entrer le nom de l'evenement">
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Lieu</span>
                                                <input class="form-control" name="location" type="text" value="<?php echo $oldLocationEv; ?>" placeholder="Entrer le lieu de l'evenement">
                                            </div>
                                            <div class="form-group">
                                                <span class="form-label">Sélectionner le(s) département(s) concerné(s) :</span>
                                                <select class="form-control" id="categorySelect">
                                                    <option value="" disabled selected hidden>Sélectionnez une departement</option>
                                                    <?php
                                                    
                                                    foreach ($tuples as $nomColonne => $donnees) {
                                                        foreach ($donnees as $valeur) {
                                                            echo "<option value='$valeur'>$valeur</option>";
                                                        }
                                                        echo "</optgroup>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="selected-departements">
                                                    <?php

                                                    if ($nomsDepartementLier > 0) {
                                                        foreach ($nomsDepartementLier as $value) {
                                                            echo ("<div style='background-color: #082D74; border: none; border-radius: 8px;' class='btn btn-success m-1'> $value <button type='button' class='btn btn-danger btn-sm ms-1' > <i class='bi bi-trash'></i> </button></div>");
                                                        }
                                                    }
                                                    ?>
                                                    
                                                </div>
                                                <input type="hidden" id="selectedDepartementsInput" name="selectedDepartements" value="">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <span class="form-label">Date</span>
                                                        <input class="form-control" name="eventDate" value="<?php echo $oldDateEv; ?>" type="date" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <span class="form-label">Heure</span>
                                                                <select class="form-control" name="eventHour">
                                                                    <option value="1" <?php if ($oldTime == "1") echo "selected"; ?>>1</option>
                                                                    <option value="2" <?php if ($oldTime == "2") echo "selected"; ?>>2</option>
                                                                    <option value="3" <?php if ($oldTime == "3") echo "selected"; ?>>3</option>
                                                                    <option value="4" <?php if ($oldTime == "4") echo "selected"; ?>>4</option>
                                                                    <option value="5" <?php if ($oldTime == "5") echo "selected"; ?>>5</option>
                                                                    <option value="6" <?php if ($oldTime == "6") echo "selected"; ?>>6</option>
                                                                    <option value="7" <?php if ($oldTime == "7") echo "selected"; ?>>7</option>
                                                                    <option value="8" <?php if ($oldTime == "8") echo "selected"; ?>>8</option>
                                                                    <option value="9" <?php if ($oldTime == "9") echo "selected"; ?>>9</option>
                                                                    <option value="10" <?php if ($oldTime == "10") echo "selected"; ?>>10</option>
                                                                    <option value="11" <?php if ($oldTime == "11") echo "selected"; ?>>11</option>
                                                                    <option value="12" <?php if ($oldTime == "12") echo "selected"; ?>>12</option>
                                                                    <option value="13" <?php if ($oldTime == "13") echo "selected"; ?>>13</option>
                                                                    <option value="14" <?php if ($oldTime == "14") echo "selected"; ?>>14</option>
                                                                    <option value="15" <?php if ($oldTime == "15") echo "selected"; ?>>15</option>
                                                                    <option value="16" <?php if ($oldTime == "16") echo "selected"; ?>>16</option>
                                                                    <option value="17" <?php if ($oldTime == "17") echo "selected"; ?>>17</option>
                                                                    <option value="18" <?php if ($oldTime == "18") echo "selected"; ?>>18</option>
                                                                    <option value="19" <?php if ($oldTime == "19") echo "selected"; ?>>19</option>
                                                                    <option value="20" <?php if ($oldTime == "20") echo "selected"; ?>>20</option>
                                                                    <option value="21" <?php if ($oldTime == "21") echo "selected"; ?>>21</option>
                                                                    <option value="22" <?php if ($oldTime == "22") echo "selected"; ?>>22</option>
                                                                    <option value="23" <?php if ($oldTime == "23") echo "selected"; ?>>23</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <span class="form-label">Minute</span>
                                                                <select class="form-control" name="eventMinute">
                                                                    <option value="00" <?php if ($oldMinute == "00") echo "selected"; ?>>00</option>
                                                                    <option value="05" <?php if ($oldMinute == "05") echo "selected"; ?>>05</option>
                                                                    <option value="10" <?php if ($oldMinute == "10") echo "selected"; ?>>10</option>
                                                                    <option value="15" <?php if ($oldMinute == "15") echo "selected"; ?>>15</option>
                                                                    <option value="20" <?php if ($oldMinute == "20") echo "selected"; ?>>20</option>
                                                                    <option value="25" <?php if ($oldMinute == "25") echo "selected"; ?>>25</option>
                                                                    <option value="30" <?php if ($oldMinute == "30") echo "selected"; ?>>30</option>
                                                                    <option value="35" <?php if ($oldMinute == "35") echo "selected"; ?>>35</option>
                                                                    <option value="40" <?php if ($oldMinute == "40") echo "selected"; ?>>40</option>
                                                                    <option value="45" <?php if ($oldMinute == "45") echo "selected"; ?>>45</option>
                                                                    <option value="50" <?php if ($oldMinute == "50") echo "selected"; ?>>50</option>
                                                                    <option value="55" <?php if ($oldMinute == "55") echo "selected"; ?>>55</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-btn">
                                                <button class="submit-btn" type="submit">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center d-flex align-items-center justify-content-center mb-5">
                    <img class="img-fluid" height="80%" width="80%" class="img-fluid" src="../assets/Add files-cuate.svg" alt="etudiant">
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
            
            let selectedDepartements = [];
            let preselectedDepartments = [];


            if (<?php echo (count($nomsDepartementLier) > 0) ?>) {

                preselectedDepartments = <?php echo $selectedDepartmentsJson; ?>;

            }

            selectedDepartements = selectedDepartements.concat(preselectedDepartments);

            
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

            
            $("#categorySelect").change(function() {
                const selectedCategory = $(this).val();
                if (selectedCategory.trim() !== "") {
                    
                    if (!selectedDepartements.includes(selectedCategory)) {
                        selectedDepartements.push(selectedCategory);
                        updateSelectedDepartements();
                        $(this).val(""); 
                    } else {
                        alert("Ce département est déjà sélectionné.");
                    }
                }
            });

           <?php echo $selectedDepartmentsJson; ?>;

            preselectedDepartments.forEach(function(departement) {
                
                const categoryItem = `
                    <div style="background-color: #082D74; border: none; border-radius: 8px;" class="btn btn-success m-1">
                        ${departement}
                        <button type="button" class="btn btn-danger btn-sm ms-1" data-category="${departement}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
                selectedDepartements.push(departement); 
                $(".selected-departements").append(categoryItem);
            });
        });
    </script>
</body>

</html>