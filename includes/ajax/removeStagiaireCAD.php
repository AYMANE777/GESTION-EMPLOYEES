<?php
require_once("../init.php");

if(isset($_POST['stID']))
{
    $stID = secureData($_POST['stID']);
    $QueryRemove = mysqli_query($connect, "DELETE FROM cad WHERE id='$stID'");
    if($QueryRemove)
    {
        $response['status'] = "success";
        $response['message'] = "Stagiaire a été retiré du C.A.D!";
    }else{
        $response['status'] = "error";
        $response['message'] = "Erreur!";
    }
}

echo json_encode($response);
?>