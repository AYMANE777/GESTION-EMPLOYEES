<?php
require_once("../init.php");
$matricule = $user->getMatricule();
if($user->getFonction() == "Formateur")
{
    $Query = mysqli_query($connect, "SELECT *, stagiaires.nom as senderNom, stagiaires.prenom as senderPrenom FROM notifications 
    INNER JOIN stagiaires
    ON stagiaires.matricule = notifications.sender_id
    WHERE receiver_id = '$matricule' ORDER BY id DESC ");
}else{
    $Query = mysqli_query($connect, "SELECT *, formateurs.nom as senderNom, formateurs.prenom as senderPrenom FROM notifications 
    INNER JOIN formateurs
    ON formateurs.matricule = notifications.sender_id
    WHERE receiver_id = '$matricule' ORDER BY id DESC");
}

if(mysqli_num_rows($Query))
{
    $list = [];
    while($notification = mysqli_fetch_assoc($Query))
    {
        $dict = array(
            "id" => $notification['id'],
            "title" => "Nouveau Message",
            "action" => $notification["action"],
            "sender" => $notification["senderPrenom"] . " " . $notification['senderNom'],
            "date" => format_time_ago($notification["date"])
        );
        array_push($list, $dict);
    }
}else{
    $list["data"] = 0;
}

echo json_encode($list);
?>