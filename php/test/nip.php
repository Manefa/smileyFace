<!--Intégrer au début de chaque pages-->
<?php
$NIP = 0000;

$correctNIP = 8264;

if ($NIP == $correctNIP) {
    //Afficher la page
} else {
    echo '<h4 style="color:red" ;>NIP non valide</h4>';
}
?>