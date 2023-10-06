<?php
session_start();
if ($_SESSION['connexion'] == false) {
    header("Location: pages/connexion.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/otp.csss">
    <link rel="stylesheet" href="../css/style_add_form.css">

</head>

<body>

    <div class="container-fluid">

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "smileface";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $idUser = $_SESSION['idUser'];
        $pinCode = "";


        $sqlUser = "SELECT pin FROM `user` WHERE `idUser` = $idUser";
        $resultUser = $conn->query($sqlUser);

        if ($resultUser->num_rows > 0) {
            while ($row = $resultUser->fetch_assoc()) {
                $pinCode = $row['pin'];
            }
        } else {
            //echo "0 results";
        }

        $conn->close();

        $pintest = "";
        $firttime = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firttime = false;
            $pintest = substr($_POST["pin"], 0, 6);
        }



        if ($pintest == $pinCode) {




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
            $image = "";
            $poste = "";

            $sqlUser = "SELECT * FROM `user` WHERE `idUser` = $idUser";
            $resultUser = $conn->query($sqlUser);

            if ($resultUser->num_rows > 0) {
                while ($row = $resultUser->fetch_assoc()) {
                    $lastname = $row['lastname'];
                    $firstname = $row['firstname'];
                    $image = $row['image'];
                    $poste = $row['poste'];
                }
            } else {
                //echo "0 results";
            }

            $pseudo = strtoupper(substr($firstname, 0, 1)) . strtoupper(substr($lastname, 0, 1));

            $fullname = ucfirst($firstname) . " " . ucfirst($lastname);

            // evenement creer par cette utilisateur 

            $sql = "SELECT * FROM `event` WHERE `idUser` = $idUser";
            $result = $conn->query($sql);
            $evenements = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $evenement = [
                        'idEv' => $row['idEv'],
                        'nom' => $row['nameEv'],
                    ];

                    array_push($evenements, $evenement);
                }
            } else {
                //echo "0 results";
            }

            $conn->close();

        ?>
            <div class="row justify-content-between g-0">
                <a href="../index.php" class="col-md-4 mt-4 ms-2 d-flex flex-row align-items-center" style="text-decoration: none; color:black;">
                    <img src="../assets/logo.svg" width="55" height="55" alt="logo">
                    <h1 class="ms-4 fw-bold">Cegep 3R</h1>
                </a>

                <div class="col-md-3 col-sm-4 mt-4 me-2 d-flex justify-content-end">
                    <a href="#" class="d-flex flex-row align-items-center justify-content-end me-2 text-decoration-none">
                        <div class=" w-100" style="border-radius: 8px; min-height: 10px;  background-color:#082D74;">
                            <h5 class="text-light mx-3 my-3"><?php echo $pseudo ?> </h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?php echo $image ?>" class="card-img-top" alt="Photo de profil">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $fullname ?></h5>
                                <p class="card-text"><?php echo $poste ?></p>
                                <a href="../pages/modifierUser.php?id=<?php echo $idUser ?>" class="btn btn-warning mt-2">Modifier mon profil</a>
                                <a href="../pages/ajouterUser.php" class="btn btn-info mt-2">Ajouter un utilisateur</a>
                                <a href="#" class="btn btn-primary mt-2">Ajouter un événement</a>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h2>Liste d'événements créés par l'utilisateur</h2>
                        <ul class="list-group mt-4">
                            <?php
                            foreach ($evenements as $evenement) {
                                echo '<a style="text-decoration: none; color: black;"; href="../pages/evenement.php?idEv=' . $evenement['idEv'] . '"><li class="list-group-item">' . $evenement['nom'] . '</li></a>';
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h2>Liste d'autres utilisateurs</h2>
                        <div class="row">
                            <?php

                            
                            $servername = "localhost";
                            $username = "root";
                            $password = "root";
                            $db = "smileface";

                            $conn = new mysqli($servername, $username, $password, $db);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }


                     
                            $sqlUsers = "SELECT * FROM `user` WHERE `idUser` != $idUser";
                            $resultUsers = $conn->query($sqlUsers);

                            if ($resultUsers->num_rows > 0) {
                                while ($row = $resultUsers->fetch_assoc()) {
                                    $otherUserId = $row['idUser'];
                                    $otherFirstname = $row['firstname'];
                                    $otherLastname = $row['lastname'];
                                    $otherImage = $row['image'];
                                    $otherPoste = $row['poste'];

                                    // Construisez la carte Bootstrap pour chaque utilisateur
                                    echo '<div class="col-md-6 mb-4">
                        <div class="card">
                            <img src="' . $otherImage . '" class="card-img-top" alt="Photo de profil">
                            <div class="card-body ">
                                <h5 class="card-title">' . ucfirst($otherFirstname) . ' ' . ucfirst($otherLastname) . '</h5>
                                <p class="card-text">' . $otherPoste . '</p>
                                <a href="userless.php?id=' . $otherUserId . '" class="btn btn-primary" >
                                    <i class="bi bi-eye"></i> 
                                </a>
                                <a href="modifierUser.php?id=' . $otherUserId . '" class="btn btn-warning mt-1">
                                <i style="color: white" class="bi bi-pencil-square"></i>
                                </a>
                                <a href="../php/supprimerUser.php?id=' . $otherUserId . '"class="btn btn-danger mt-1">
                                <i class="bi bi-trash"></i> 
                                </a>
                            </div>
                        </div>
                    </div>';
                                }
                            } else {
                                echo 'Aucun autre utilisateur trouvé.';
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>



                </div>
            </div>
    </div>

<?php
        } else {

?>

    <div class="container-fluid">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row d-flex justify-content-center align-items-center vh-100">

                <div class="col-md-4 text-center">
                    <img src="../assets/Security On-cuate.svg" alt="" srcset="">
                    <h1 class="fw-bold" id="textIntro">Verifier votre identite</h1>
                </div>

                <div class="col-md-4">
                    <div class="container d-flex justify-content-center align-items-center h-100">
                        <div class="position-relative">
                            <div class="card p-2 text-center">
                                <h5>Svp entrer votre pin a 6 chiffres <br> pour verifier votre compte</h5>
                                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                    <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" id="otpStatus" hidden type="text" name="pin" maxlength="1" />
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-warning px-4 validate text-light fw-bold" style="  color: #ffffff;background-color: #082d74;font-weight: 700;height: 50px;border: none;width: 50%;border-radius: 8px;text-transform: uppercase;" type="submit">Verifier</button>


                                </div>
                                <?php

                                if ($firttime == false) {
                                ?> <span style="color: red;">Mauvais code reesayer !</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



<?php
        }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        function OTPInput() {
            const inputs = document.querySelectorAll('#otp > *[id]');
            const otpStatusInput = document.getElementById('otpStatus');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function(event) {
                    if (event.key === "Backspace") {
                        inputs[i].value = '';
                        if (i !== 0) inputs[i - 1].focus();
                    } else {
                        if (i === inputs.length - 1 && inputs[i].value !== '') {
                            return true;
                        } else if (event.keyCode > 47 && event.keyCode < 58) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1) inputs[i + 1].focus();
                            event.preventDefault();
                        } else if (event.keyCode > 64 && event.keyCode < 91) {
                            inputs[i].value = String.fromCharCode(event.keyCode);
                            if (i !== inputs.length - 1) inputs[i + 1].focus();
                            event.preventDefault();
                        }
                    }


                    const otpValue = Array.from(inputs).map(input => input.value).join('');

                    otpStatusInput.value = otpValue;
                });

            }



        }
        OTPInput();


    });
</script>
</body>

</html>