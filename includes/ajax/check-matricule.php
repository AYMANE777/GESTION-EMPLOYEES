<?php
require_once("../init.php");

if(isset($_POST['mat']))
{
    $mat = secureData($_POST['mat']);

    $QueryCheck = mysqli_query($connect, "SELECT * FROM stagiaires WHERE matricule='$mat'");
    if(mysqli_num_rows($QueryCheck) > 0)
    {
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }

   
}
?>