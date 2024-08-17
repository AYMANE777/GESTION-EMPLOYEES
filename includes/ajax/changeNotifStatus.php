<?php
require_once("../init.php");
$matricule = $user->getMatricule();
$notifID = secureData($_POST['notifID']);
    mysqli_query($connect, "UPDATE notifications SET isRead='1' WHERE receiver_id = '$matricule'");
?>