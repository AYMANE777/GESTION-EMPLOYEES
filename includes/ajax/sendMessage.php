<?php
require_once("../init.php");

if(isset($_POST['receiverid']) && isset($_POST['subject']) && isset($_POST['message']))
{
    $receiverid = secureData($_POST['receiverid']);
    $subject = secureData($_POST['subject']);
    $message = secureData($_POST['message']);
    $matricule = $user->getMatricule();

    if(!empty($receiverid) && !empty($subject) && !empty($message) && !empty($matricule))
    {
        $QueryAddMessage = mysqli_query($connect, "INSERT INTO messages(subject, content, date_sent, sender_id, receiver_id, isRead, isDeleted) VALUES ('$subject', '$message', '$current_date', '$matricule', '$receiverid', 0, 0)");
        if($QueryAddMessage)
        {
            addNotif($receiverid, "a envoyé un message", $matricule);
            $response['status'] = "success";
            $response['message'] = "Votre message a bien envoyée!";
        }else{
            $response['status'] = "error";
            $response['message'] = $connect->error;
        }
    }
}

echo json_encode($response);
?>