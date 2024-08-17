<?php
require_once("../init.php");

if(isset($_POST['reply']))
{
    $reply = secureData($_POST['reply']);
    $messageID = $_SESSION['message-id'];
    $matricule = $user->getMatricule();
    $QueryCheck = mysqli_query($connect, "INSERT INTO replies(message_id, reply, reply_date, sender_id) VALUES ('$messageID', '$reply', '$current_date', '$matricule')");

    if($QueryCheck)
    {
        $response['status'] = "success";
        $response['message'] = "Votre réponse est bien ajouté!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}

echo json_encode($response);
?>