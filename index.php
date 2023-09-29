<?php
// ... (votre code PHP de session_start() et de connexion à la base de données ici) ...

$servername = "localhost";
$username = "root";
$password = "root";
$db = "smileface";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query('SET NAMES utf8');
$sql = "SELECT * FROM event";

$result = $conn->query($sql);

$evenements_a_venir = [];
$evenements_passes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $evenement = [
            'nom' => $row['nameEv'],
            'date' => $row['dateEv'],
            'location' => $row['locationEv']
        ];

        // Determinez si l'événement est à venir ou passé en fonction de la date
        date_default_timezone_set('America/New_York');
        $date_evenement = strtotime($row['dateEv']);
        $aujourd_hui = time();
        if ($date_evenement > $aujourd_hui) {
            $evenements_a_venir[] = $evenement;
        } else {
            $evenements_passes[] = $evenement;
        }
    }
} else {
    //echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="row d-flex justify-content-between ">
                <div class="col-md-4 mt-4 ms-4 d-flex flex-row align-items-center">
                    <img src=" assets/logo.svg" width="68" height="67" alt="logo">
                    <h1 class="ms-4 fw-bold ">Cegep Tr</h1>
                </div>


                <div class=" col-md-2 mt-4 me-4 d-flex justify-content-end">

                    <a href="pages/user.php" class="d-flex flex-row align-items-center justify-content-end me-2" style="text-decoration: none;">
                        <div class="bg-secondary bg-opacity-50 w-100" style="border-radius: 8px; min-height: 10px;">
                            <h5 class="text-dark mx-3 my-3">GG</h5>
                        </div>
                    </a>

                    <a href="pages/ajouter.php" class="d-flex flex-row align-items-center justify-content-end me-2" style="text-decoration: none;">
                        <div class="bg-success bg-opacity-70 w-100 p-3 rounded">
                            <i class="bi bi-plus-lg text-light" style="font-size: 1rem;"></i>
                        </div>
                    </a>

                    <a href="php/deconnexion.php" class="d-flex flex-row align-items-center justify-content-end" style="text-decoration: none;">
                        <div class="bg-danger bg-opacity-70 w-100 p-3 rounded">
                            <i class="bi bi-box-arrow-right text-light"></i>
                        </div>
                    </a>


                </div>

            </div>
        </div>

        <div class="row">
            <h1 style="padding-left: 0px;" class="ms-4 mt-5">Evenements à venir</h1>
        </div>

        <div class="row d-flex justify-content-start ms-1 me-4 mt-2">
            <?php if (empty($evenements_a_venir)) : ?>
                <!-- Aucun événement à venir -->
                <div class="col-md-12 text-center">
                    <img src="chemin/vers/votre/svg.svg" alt="Aucun événement à venir">
                    <p>Aucun événement à venir pour le moment.</p>
                </div>
            <?php else : ?>
                <!-- Affichez les événements à venir -->
                <?php foreach ($evenements_a_venir as $evenement) : ?>
                    <div class="card mx-2 my-2" style="width: 22rem;">
                        <!-- Votre code pour afficher les événements à venir ici -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $evenement['nom'] ?></h5>
                            <div class="mb-5 d-flex">
                                <p class="card-text">informatique</p>
                                <p class="card-text ms-1 me-1">|</p>
                                <p class="card-text"><?= $evenement['location'] ?></p>
                            </div>
                            <div class="col-md-12 mt-5 d-flex justify-content-end">
                                <button type="button" class="btn btn-danger me-2">
                                    <a href="connexion.php">
                                        <img src="assets/Delete 3.svg" alt="">
                                    </a>
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <a href="ajouter.php"><img src="assets/Edit 3.svg" alt=""></a>
                                </button>
                                <button type="button" class="btn btn-danger ms-2">
                                    <a href="connexion.php">
                                        <img src="assets/Delete 3.svg" alt="">
                                    </a>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                    </div>

                    <div class="row">
                        <h1 style="padding-left: 0px;" class="ms-4 mt-5">Evenements passés</h1>
                    </div>

                    <div class="row d-flex justify-content-start ms-1 me-4 mt-2">
                        <?php if (empty($evenements_passes)) : ?>
                            <!-- Aucun événement passé -->
                            <div class="col-md-12 text-center">
                                <img src="chemin/vers/votre/svg.svg" alt="Aucun événement passé">
                                <p>Aucun événement passé pour le moment.</p>
                            </div>
                        <?php else : ?>
                            <!-- Affichez les événements passés -->
                            <?php foreach ($evenements_passes as $evenement) : ?>
                                <div class="card mx-2 my-2" style="width: 22rem;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?= $evenement['nom'] ?></h5>
                                        <div class="mb-5 d-flex">
                                            <p class="card-text">informatique</p>
                                            <p class="card-text ms-1 me-1">|</p>
                                            <p class="card-text"><?= $evenement['location'] ?></p>
                                        </div>
                                        <div class="col-md-12 mt-5 d-flex justify-content-end">
                                            <button type="button" class="btn btn-warning">
                                                <img src="assets/Edit 3.svg" alt="">
                                            </button>
                                            <button type="button" class="btn btn-danger ms-2">
                                                <img src="assets/Delete 3.svg" alt="">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
        </div>

        <!-- ... Votre code HTML précédent ... -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>