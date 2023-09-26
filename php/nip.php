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
    <title>Veuillez entrer le NIP</title>
</head>
<body>
    <?php 
    $nip = 1234
    


    ?>
</body>
</html>