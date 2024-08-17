<?php
require_once("../init.php");

if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['type']))
{
    $title = secureData($_POST['title']);
    $content = secureData($_POST['content']);
    $type = secureData($_POST['type']);
    $matricule = $user->getMatricule();

    if(!empty($title) && !empty($content)&& !empty($matricule))
    {
        $QueryAddMessage = mysqli_query($connect, "INSERT INTO problemes(titre, content, date_reclamation, statut, stagiaire_mat, type) VALUES ('$title', '$content', '$current_date', 'En attente', '$matricule', '$type')");
        if($QueryAddMessage)
        {
            $response['status'] = "success";
            $response['message'] = "Votre réclamation a bien envoyée !";
        }else{
            $response['status'] = "error";
            $response['message'] = $connect->error;
        }
    }
}

echo json_encode($response);
?>