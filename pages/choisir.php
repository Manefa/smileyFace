<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo "Erreur";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custumBouton.css">
    <title>Index</title>

    <style>
        /* Classe pour indiquer la sélection d'une image */
        .selected-image {
            border: 2px solid green;
            /* Par exemple, utilisez un cadre vert pour montrer la sélection */
            opacity: 0.8;
            /* Réduire légèrement l'opacité de l'image sélectionnée */
        }

        .clickable {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="70" height="70" alt="logo">
                <h1 class="ms-5 fw-bold ">Cegep Tr</h1>
            </div>
        </div>
        <div class="row">
            <div class="row mt-4 d-flex align-items-center justify-content-center">
                <div class="col-md-3 text-center">
                    <h1 class="fw-bold">Choisissez le profil qui va voter</h1>
                </div>
            </div>
            <div class="row mt-4 d-flex align-items-center justify-content-center">
                <div class="col-md-5 text-center">
                    <!-- Ajoutez un lien autour de l'image et du texte -->
                    <a href="javascript:void(0);" style="color: black; text-decoration: none;" class="clickable" onclick="selectImage('etudiant')">
                        <img class="img-fluid" height="60%" width="60%" src="../assets/boy on graduation-cuate.svg" alt="etudiant">
                        <h1 class="fw-bold">Etudiant</h1>
                    </a>
                </div>
                <div class="col-md-5 text-center">
                    <!-- Ajoutez un lien autour de l'image et du texte -->
                    <a href="javascript:void(0);" style="color: black; text-decoration: none;" class="clickable" onclick="selectImage('employeur')">
                        <img class="img-fluid" height="60%" width="60%" class="img-fluid" src="../assets/Business deal-cuate.svg" alt="employeur">
                        <h1 class="fw-bold">Employeur</h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center align-items-center">
            <div class="col-md-4 ">
                <div href="#" class="btn btn-new d-flex justify-content-center align-items-center">
                    <h3><a class="me-0" style="color: white; text-decoration: none; " href="pages/evaluation.php">Commencer !</a></h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variable pour stocker la sélection (0 pour aucune sélection, 1 pour étudiant, 2 pour employeur)
        let selectedImage = 0;
        let selectedProfil = 0;

        // Fonction pour gérer la sélection d'image
        function selectImage(imageType) {

            if (selectedImage === 0) {
                selectedImage = imageType;


                document.querySelector(`img[alt="${imageType}"]`).classList.add('selected-image');
            } else if (selectedImage === imageType) {
                selectedImage = 0;

                document.querySelector(`img[alt="${imageType}"]`).classList.remove('selected-image');
            }

            if (selectedImage === "etudiant") {
                selectedProfil = 1;
            }

            if (selectedImage === "employeur") {
                selectedProfil = 2;
            }

            console.log(selectedProfil);

            window.location.href = `evaluation.php?profil=${selectedProfil}&eventId=<?php echo $id ?>`;

        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>