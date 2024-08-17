<?php
require_once("../init.php");

$user_groupe_nom = $user->getGroupe();

$Query = mysqli_query($connect, "SELECT matricule, nom, prenom, module, formateurs.groupe_id, groupe_nom FROM formateurs
INNER JOIN groupes
ON formateurs.groupe_id = groupes.groupe_id
WHERE groupe_nom = '$user_groupe_nom' ");
$row = mysqli_fetch_assoc($Query);
echo json_encode($row);
?>