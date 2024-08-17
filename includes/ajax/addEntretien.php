<?php
require_once("../init.php");

if(isset($_POST['subject']) && isset($_POST['description']) && isset($_POST['type']) && isset($_POST['tool']) && isset($_POST['date']) && isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['stagiaire']))
{
    $subject = secureData($_POST['subject']);
    $description = secureData($_POST['description']);
    $type = secureData($_POST['type']);
    $tool = secureData($_POST['tool']);
    $date = secureData($_POST['date']);
    $startTime = secureData($_POST['startTime']);
    $endTime = secureData($_POST['endTime']);
    $stagiaire = secureData($_POST['stagiaire']);
    $matricule = $user->getMatricule();

    $QueryAddMessage = mysqli_query($connect, "INSERT INTO entretiens(subject, description, type, outil, date_entretien, heure_debut, heure_fin, formateur_mat, stagiaire_mat)
     VALUES ('$subject', '$description', '$type', '$tool', '$date', '$startTime', '$endTime', '$matricule', '$stagiaire')");
    if($QueryAddMessage)
    {
        $response['status'] = "success";
        $response['message'] = "Votre entretien a été ajouté avec succès.";
    }else{
        $response['status'] = "error";
        $response['message'] = $connect->error;
    }
}

echo json_encode($response);
?>