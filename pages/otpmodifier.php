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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/otp.css">
    <title>Otp</title>
</head>

<body>
    <?php
    /* $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "smileface";
    $pintest = "";
    $firttime = true;

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } */

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firttime = false;
        $pintest = substr($_POST["pin"], 0, 6);
    }

    if ($pintest == $pinCode) {
        header("Location: user.php");
    }


    $conn->close();


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
                                    <button class="btn btn-warning px-4 validate text-light fw-bold" style="  color: #ffffff;background-color: #082d74;font-weight: 700;height: 50px;border: none;width: 100%;border-radius: 8px;text-transform: uppercase;" type="submit">Verifier</button>

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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="../js/sh_toaster.js"></script>
        <script src="../js/otpjs.js"></script>
    </div>
</body>

</html>