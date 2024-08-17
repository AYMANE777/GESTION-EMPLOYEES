<?php
require_once("../init.php");
$mat = $user->getMatricule();
if(isset($_POST['entretienID']))
{
    $entretienID = $_POST['entretienID'];
    $QueryDelete = mysqli_query($connect, "DELETE FROM entretiens WHERE entretien_id = $entretienID AND formateur_mat = $mat");
    if($QueryDelete)
    {
        $response['status'] = "success";
        $response['message'] = "L'entretien a été bien supprimé!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}


echo json_encode($response);
?>