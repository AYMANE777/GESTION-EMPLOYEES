<?php
require_once("../init.php");

if(isset($_POST['reclamationID']))
{
    $reclamationID = secureData($_POST['reclamationID']);
    $QueryRemove = mysqli_query($connect, "UPDATE problemes SET statut='Annulé' WHERE problem_id='$reclamationID'");
    if($QueryRemove)
    {
        $response['status'] = "success";
        $response['message'] = "Statut de cette réclamation a été bien modifé!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}

echo json_encode($response);
?>