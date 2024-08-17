<?php
require_once("../init.php");

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type']))
{
    $username = secureData($_POST['username']);
    $password = secureData($_POST['password']);
    $type = secureData($_POST['type']);

    $credentials[] = "";

    if($type == 1)
    {
        $credentials["table"] = "formateurs";
        $credentials["column"] = "matricule";
        $credentials["where"] = "";
    }else if($type == 2)
    {
        $credentials["table"] = "stagiaires";
        $credentials["column"] = "matricule";
        $credentials["where"] = "";
    }else if($type == 3)
    {
        $credentials["table"] = "employés";
        $credentials["column"] = "cin";
        $credentials["where"] = "AND fonction='Directeur'";
    }else if($type == 4)
    {
        $credentials["table"] = "employés";
        $credentials["column"] = "cin";
        $credentials["where"] = "AND fonction='Conseilleur'";
    }

    $SQLCheckUser = "SELECT * FROM ".$credentials["table"]." WHERE ".$credentials["column"]."='$username' AND password='$password' ".$credentials["where"]." ";
    $SQLResult = mysqli_query($connect, $SQLCheckUser);

    if(mysqli_num_rows($SQLResult) > 0)
    {
        $row = mysqli_fetch_assoc($SQLResult);
        $_SESSION['userid'] = $username;
        $_SESSION['type'] = $type;
        if($type == 1 || $type == 2)
        {
            $_SESSION['groupe_id'] = $row['groupe_id'];
        }
        $response['status'] = "success";
        $response['message'] = "Bienvenue " . $row["prenom"] . " ".$row['nom']." !";
    }else{
        $response['status'] = "error";
        $response['message'] = "les informations d'identification invalides.";
    }
    
}

echo json_encode($response)
?>