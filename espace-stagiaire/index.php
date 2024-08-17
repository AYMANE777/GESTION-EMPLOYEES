<?php
if($user->getFonction() != "Stagiaire") { echo '<script>location.replace("../connexion")</script>'; }
header("Location: dashboard");
?>