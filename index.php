<?php
session_start();

if ($_SESSION['connexion'] == false) {
    header("Location: pages/connexion.php");
}
// ... (votre code PHP de session_start() et de connexion à la base de données ici) ...

$servername = "localhost";
$username = "root";
$password = "root";
$db = "smileface";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idUser = $_SESSION['idUser'];
$firstname = "";
$lastname = "";
$pseudo = "";

$conn->query('SET NAMES utf8');
$sql = "SELECT * FROM event";
$result = $conn->query($sql);

$sqlUser = "SELECT * FROM `user` WHERE `idUser` = $idUser";
$resultUser = $conn->query($sqlUser);

if ($resultUser->num_rows > 0) {
    while ($row = $resultUser->fetch_assoc()) {
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
    }
} else {
    //echo "0 results";
}

$pseudo = strtoupper(substr($firstname, 0, 1)) . strtoupper(substr($lastname, 0, 1));

$evenements_a_venir = [];
$evenements_passes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $evenement = [
            'idEv' => $row['idEv'],
            'nom' => $row['nameEv'],
            'date' => $row['dateEv'],
            'location' => $row['locationEv'],
            'time' => $row['timeEv']
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
        <div class="row justify-content-between g-0">
            <div class="col-md-4 col-sm-5 mt-4 ms-2 d-flex flex-row align-items-center">
                <img src="assets/logo.svg" width="55" height="55" alt="logo">
                <h1 class="ms-4 fw-bold">Cegep 3R</h1>
            </div>

            <div class="col-md-3 col-sm-4 mt-4 me-2 d-flex justify-content-end">
                <a href="pages/otpcopy.php" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                    <div class=" w-100" style="border-radius: 8px; min-height: 10px;  background-color:#082D74;">
                        <h5 class="text-light mx-3 my-3"><?php echo $pseudo ?> </h5>
                    </div>
                </a>

                <a href="pages/ajouter.php" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                    <div class="bg-success bg-opacity-70 w-100 p-3 rounded">
                        <i class="bi bi-plus-lg text-light" style="font-size: 1rem;"></i>
                    </div>
                </a>

                <a href="php/deconnexion.php" class="d-flex flex-row align-items-center justify-content-end text-decoration-none">
                    <div class="bg-danger bg-opacity-70 w-100 p-3 rounded">
                        <i class="bi bi-box-arrow-right text-light"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-0">
            <h1 class="ms-4 mt-5">Evenements à venir</h1>
        </div>

        <div class="row d-flex justify-content-start ms-1 me-4 mt-2 g-0">
            <?php if (empty($evenements_a_venir)) : ?>

                <div class="col-md-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="col-md-4 ">
                        <img src="assets/Empty-cuate.svg" class="img-fluid" alt="Aucun événement à venir">
                        <h2>Aucun événement à venir pour le moment.</h2>
                    </div>

                </div>


            <?php else : ?>
                <?php foreach ($evenements_a_venir as $evenement) : ?>
                    <div class="col-md-4 ">
                        <a href="pages/evenement.php?idEv=<?php echo $evenement['idEv'] ?>" class="" style="text-decoration: none; color: black; ">
                            <div class="card mx-2 my-2" style="width: 18rem;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= $evenement['nom'] ?></h5>
                                    <div class="mb-5 d-flex">
                                        <p class="card-text"><?= date("d M Y", strtotime($evenement['date'])) ?></p>
                                        <p class="card-text ms-1 me-1">|</p>
                                        <p class="card-text"><?= $evenement['time'] ?></p>
                                        <p class="card-text ms-1 me-1">|</p>
                                        <p class="card-text"><?= $evenement['location'] ?></p>
                                    </div>
                                    <div class="col-md-12 mt-5 d-flex justify-content-end">
                                        <a href="pages/choisir.php?id=<?= $evenement['idEv']; ?>">
                                            <button type="button" class="btn btn-primary">
                                                <i style="color: white" class="bi bi-box-seam"></i>
                                            </button>
                                        </a>
                                        <a href="pages/modifier.php?id=<?= $evenement['idEv']; ?>">
                                            <button type="button" class="btn btn-warning ms-2">
                                                <i style="color: white" class="bi bi-pencil-square"></i>
                                            </button>
                                        </a>
                                        <a href="php/supprimer.php?id=<?= $evenement['idEv']; ?>">
                                            <button type="button" class="btn btn-danger ms-2">
                                                <i style="color: white" class="bi bi-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="row g-0">
            <h1 class="ms-4 mt-5">Evenements passés</h1>
        </div>

        <div class="row d-flex justify-content-between ms-1 me-4 mt-2 g-0">
            <?php if (empty($evenements_passes)) : ?>
                <div class="col-md-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="col-md-4 ">
                        <img src="assets/Empty-cuate.svg" alt="Aucun événement passé">
                        <h2>Aucun événement passé pour le moment.</h2>
                    </div>

                </div>
            <?php else : ?>
                <?php foreach ($evenements_passes as $evenement) : ?>
                    <div class="card mx-2 my-2" style="width: 18rem;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $evenement['nom'] ?></h5>
                            <div class="mb-5 d-flex">
                                <p class="card-text"><?= date("d M Y", strtotime($evenement['date'])) ?></p>
                                <p class="card-text ms-1 me-1">|</p>
                                <p class="card-text"><?= $evenement['time'] ?></p>
                                <p class="card-text ms-1 me-1">|</p>
                                <p class="card-text"><?= $evenement['location'] ?></p>
                            </div>
                            <div class="col-md-12 mt-5 d-flex justify-content-end">
                                <a href="pages/modifier.php?id=<?= $evenement['idEv']; ?>">
                                    <button type="button" class="btn btn-warning">
                                        <i style="color: white" class="bi bi-pencil-square"></i>
                                    </button>
                                </a>
                                <a href="php/supprimer.php?id=<?= $evenement['idEv']; ?>">
                                    <button type="button" class="btn btn-danger ms-2">
                                        <i style="color: white" class="bi bi-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>