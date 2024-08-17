<?php
require_once("../init.php");

$grouepID = $_SESSION['groupe_id'];
$list = [];
$Query = mysqli_query($connect, "SELECT * FROM stagiaires WHERE groupe_id ='$grouepID' ");
while($row = mysqli_fetch_assoc($Query))
{
    $dict = array(
        "value" => $row["matricule"],
        "name" => $row["prenom"] . " " . $row['nom']
    );

    array_push($list, $dict);

}
echo json_encode($list);
?>