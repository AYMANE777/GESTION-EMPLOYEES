<?php
require_once("../init.php");
$mat = $user->getMatricule();
if(isset($_POST['activityID']))
{
    $activityID = $_POST['activityID'];
    $QueryGetImage = mysqli_query($connect, "SELECT attachment FROM activities WHERE activity_id = $activityID AND formateur_mat = $mat");
    $image = mysqli_fetch_assoc($QueryGetImage);
    unlink("../".$image['attachment']."");
    $QueryDelete = mysqli_query($connect, "DELETE FROM activities WHERE activity_id = $activityID AND formateur_mat = $mat");
    if($QueryDelete)
    {
        $response['status'] = "success";
        $response['message'] = "L'activité a été bien supprimé!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}


echo json_encode($response);
?>