<?php
require_once("../init.php");

if(!empty($_SESSION['problem-id']))
{
    $problemID = secureData($_SESSION['problem-id']);
}else{
    $problemID = $_POST['problemID'];
}

$QueryDelete = mysqli_query($connect, "DELETE FROM problemes WHERE problem_id = $problemID");
if($QueryDelete)
{
    $response['status'] = "success";
    $response['message'] = "La réclamation a été bien supprimé!";
}else{
    $response['status'] = "error";
    $response['message'] = "Erreur!";
}
echo json_encode($response);
?>