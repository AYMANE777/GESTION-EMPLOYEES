<?php
require_once("../init.php");

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['link']))
{
    $title = secureData($_POST['title']);
    $description = secureData($_POST['description']);
    $link = secureData($_POST['link']);

    if(!empty($title) && !empty($description)&& !empty($link))
    {
        $QueryAddTuto = mysqli_query($connect, "INSERT INTO tutorials(title, description, youtube) VALUES ('$title', '$description', '$link')");
        if($QueryAddTuto)
        {
            $response['status'] = "success";
            $response['message'] = "Votre support a bien enregistré !";
        }else{
            $response['status'] = "error";
            $response['message'] = $connect->error;
        }
    }
}

echo json_encode($response);
?>