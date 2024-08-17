<?php
require_once("../init.php");
$matricule = $user->getMatricule();
$Query = mysqli_query($connect, "SELECT * FROM notifications WHERE receiver_id = '$matricule' AND isRead = 0");
$response["data"] = mysqli_num_rows($Query);
echo json_encode($response);
?>