<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: connexion.php");
}

if (isset($_GET['profil'])) {
    $idProfil = $_GET['profil'];
    //var_dump($idProfil);
}

if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];
    //var_dump($eventId);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custumBouton.css">
    <link rel="stylesheet" href="../css/title-css.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        
        .selected-image {
            opacity: 0.8;
            border-radius: 50%;
            position: relative;
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }


        .clickable {
            cursor: pointer;
            transition: opacity 0.3s ease-in-out;
           
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center">
                <img src="../assets/logo.svg" width="70" height="70" alt="logo">
                <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
            </div>


            <div class="col-md-3 mt-4 ms-4 ">
                <a href="../index.php" class="d-flex flex-row align-items-center justify-content-end " style="text-decoration: none;">
                    <img src="../assets/exit.svg" width="50" height="50" alt="sortir img">
                    <h1 class="ms-2 me-4 text-black">Sortir</h1>
                </a>
            </div>

        </div>


        <div class="row d-flex mt-5 align-items-center justify-content-center">
            <div class="col-md-4 text-center">
                <h1 class="fw-bold" id="textIntro">Avez vous apprecier l’evenement </h1>
            </div>
        </div>

        <div class="row mt-5 d-flex align-items-center justify-content-center">

            <div class="col-md-4 text-center d-flex justify-content-end">
                <img class="img-fluid clickable" height="60%" width="60%" src="../assets/face_amazed.svg" alt="amazed" onclick="selectImage(this)">
            </div>
            <div class="col-md-4 text-center">
                <img class="img-fluid clickable" height="60%" width="60%" src="../assets/face_neutral.svg" alt="neutral" onclick="selectImage(this)">
            </div>
            <div class="col-md-4 text-center d-flex justify-content-start">
                <img class="img-fluid clickable" height="60%" width="60%" src="../assets/face_angry.svg" alt="angry" onclick="selectImage(this)">
            </div>


        </div>

    </div>


    <script>
        // Variables pour stocker la sélection (0 pour aucune sélection, 1 pour la première image, 2 pour la deuxième image, 3 pour la troisième image)
        let selectedImage = 0;
        let vote = 0;

        function selectImage(image) {
            const imageType = image.getAttribute('alt');

            // Mettre à jour la variable vote en fonction de l'image sélectionnée
            if (imageType === "amazed") {
                vote = 1;
            } else if (imageType === "neutral") {
                vote = 2;
            } else if (imageType === "angry") {
                vote = 3;
            }

            // Envoyer les données de vote au serveur
            console.log(vote);
            console.log(<?php echo (trim($idProfil));  ?>);
            console.log(<?php echo (trim($eventId)); ?>);
            window.location.href = `../php/voter.php?profil=<?php echo (trim($idProfil)); ?>&eventId=<?php echo (trim($eventId)); ?>&vote=${vote}`;
        }
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>