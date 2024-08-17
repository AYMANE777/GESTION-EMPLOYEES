<?php
require_once("../init.php");

if(isset($_POST['messageID']))
{
    $messageID = secureData($_POST['messageID']);
    $matricule = $user->getMatricule();
    $QueryCheck = mysqli_query($connect, "UPDATE messages SET isDeleted=1 WHERE message_id='$messageID'");
    if($QueryCheck)
    {
        $response['status'] = "success";
        $response['message'] = "Le message a été bien supprimé!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}

echo json_encode($response);
?>