<?php
require_once("../init.php");
if(isset($_POST['matricule']))
{
    $stagiaire_matricule = $_POST['matricule'];
    if(!empty($stagiaire_matricule))
    {
        $Query = mysqli_query($connect, "SELECT * FROM stagiaires WHERE matricule='$stagiaire_matricule'");
        if(mysqli_num_rows($Query) > 0)
        {
            $stagiaire = mysqli_fetch_assoc($Query);
        }
    }
}

echo json_encode($stagiaire);
?>