<?php
require_once("../init.php");

if(isset($_POST['stagiaire']) && isset($_POST['fonction']))
{
    $stagiaire = secureData($_POST['stagiaire']);
    $fonction = secureData($_POST['fonction']);
    if(!empty($stagiaire) && !empty($fonction))
    {
        $QuerAddStagiaire = mysqli_query($connect, "INSERT INTO cad(stagiaire_mat, fonction) VALUES ('$stagiaire', '$fonction')");
        if($QuerAddStagiaire)
        {
            $response['status'] = "success";
            $response['message'] = "Stagiaire a bien ajouté au C.A.D !";
        }else{
            $response['status'] = "error";
            $response['message'] = $connect->error;
        }
    }
}

echo json_encode($response);
?>