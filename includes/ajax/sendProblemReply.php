<?php
require_once("../init.php");

if(isset($_POST['reply']))
{
    $reply = secureData($_POST['reply']);
    if($user->getFonction() == "Formateur" || $user->getFonction() == "Stagiaire")
    {
        $matricule = $user->getMatricule();
    }else{
        $matricule = $user->getCIN();
    }
    
    $problemID = $_SESSION['problem-id'];
    $QueryCheck = mysqli_query($connect, "INSERT INTO problemes_replies(problem_id, problem_reply, sender_id, reply_date) VALUES ('$problemID', '$reply', '$matricule', '$current_date')");

    if($QueryCheck)
    {
        $response['status'] = "success";
        $response['message'] = "Votre commentaire est bien ajouté!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}

echo json_encode($response);
?>