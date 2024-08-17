<?php
require_once("../init.php");

if(isset($_POST['newpass']) && isset($_POST['cnewpass']))
{
    $newpass = secureData($_POST['newpass']);
    $cnewpass = secureData($_POST['cnewpass']);
    $type = $_SESSION["type"];
    $userid = $_SESSION['userid'];
    if($type == 1)
    {
        $credentials["table"] = "formateurs";
        $credentials["column"] = "matricule";
        $credentials["where"] = "";
    }else if($type == 2)
    {
        $credentials["table"] = "stagiaires";
        $credentials["column"] = "matricule";
    }else if($type == 3 || $type == 4)
    {
        $credentials["table"] = "employés";
        $credentials["column"] = "cin";
    }

    if(!empty($newpass) && !empty($cnewpass) && $newpass == $cnewpass)
    {
        $SQLResult = mysqli_query($connect, "UPDATE ". $credentials["table"]." set password = '$newpass' WHERE ".$credentials["column"]." = '$userid'");
        if($SQLResult)
        {
            $response['status'] = "success";
            $response['message'] = "Votre mot de passe est bien modifé!";
            session_destroy();
        }else{
            $response['status'] = "error";
            $response['message'] = "Echec de modifier votre mot de passe!";
        }
        
    }
}

echo json_encode($response)
?>