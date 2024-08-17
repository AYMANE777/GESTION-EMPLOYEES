<?php
require_once("../init.php");
if(isset($_POST['reply_id']))
{
    $reply_id = $_POST['reply_id'];
    $QueryDelete = mysqli_query($connect, "DELETE FROM problemes_replies WHERE problem_reply_id = $reply_id");
    if($QueryDelete)
    {
        $response['status'] = "success";
        $response['message'] = "Le commentaire a été bien supprimé!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}

echo json_encode($response);
?>