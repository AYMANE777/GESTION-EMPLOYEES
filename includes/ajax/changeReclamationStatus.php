<?php
require_once("../init.php");

if(isset($_POST['status']))
{
    $status = secureData($_POST['status']);
    $reclamationiID = $_SESSION['problem-id'];
    $matricule = $user->getMatricule();
    $QueryRemove = mysqli_query($connect, "UPDATE problemes SET statut='$status' WHERE problem_id='$reclamationiID'");
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