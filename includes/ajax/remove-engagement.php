<?php
require_once("../init.php");

if(isset($_POST['engID']))
{
    $engid = secureData($_POST['engID']);
    if(!isConseilleur())
    {
        $response['status'] = "error";
        $response['message'] = "Vous n'avez pas l'autorisation d'effectuer cette operation!";
    }else{
        if(checkEngagementID($engid))
        {
            $SQLRemove = mysqli_query($connect, "DELETE FROM engagements WHERE eng_id='$engid'");
            if($SQLRemove)
            {
                $response['status'] = "success";
                $response['message'] = "L'engagement a été bien supprimé!";
            }else{
                $response['status'] = "success";
                $response['message'] = $connect->error;
            }
        }else{
            $response['status'] = "error";
            $response['message'] = "Invalide engagement id!";
        }
    }

   
}

echo json_encode($response)
?>