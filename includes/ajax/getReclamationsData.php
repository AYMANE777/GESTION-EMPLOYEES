<?php
require_once("../init.php");
$QueryGetAtt = mysqli_query($connect, "SELECT * FROM problemes WHERE statut = 'En attente'");
$QueryGetResolu = mysqli_query($connect, "SELECT * FROM problemes WHERE statut = 'Résolu'");
$QueryAnnule = mysqli_query($connect, "SELECT * FROM problemes WHERE statut = 'Annulé'");
if(isset($_GET['id']))
{
    if($_GET['id'] == 1)
    {
        echo mysqli_num_rows($QueryGetAtt);
    }else if($_GET['id'] == 2){
        echo mysqli_num_rows($QueryGetResolu);
    }else if($_GET['id'] == 3){
        echo mysqli_num_rows($QueryAnnule);
    }else{
        echo "ERROR";
    }
}
?>