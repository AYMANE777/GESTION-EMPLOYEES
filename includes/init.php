<?php
@session_start();
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
require_once("config.inc.php");
require_once("functions.inc.php");
require_once("classes/person.class.php");
require_once("classes/formateur.class.php");
require_once("classes/stagiaire.class.php");
require_once("classes/directeur.class.php");
require_once("classes/conseilleur.class.php");

$current_date = date("Y-m-d h:i:s");
$target_dir = "../uploads/";
if(isset($_SESSION['userid']))
{
    $userid = $_SESSION['userid'];
    if($_SESSION['type'] == 1)
    {
        
        $SQLExecuteQuery = mysqli_query($connect, "SELECT matricule, nom, prenom, module, formation_year, groupe_nom, password FROM formateurs LEFT JOIN groupes on formateurs.groupe_id = groupes.groupe_id where matricule='$userid'");
        if(mysqli_num_rows($SQLExecuteQuery) > 0)
        {
            $row = mysqli_fetch_assoc($SQLExecuteQuery);
            $user = new Formateur();
            $user->setMatricule($userid);
            $user->setNom($row["nom"]);
            $user->setPrenom($row["prenom"]);
            $user->setGroupe($row["groupe_nom"]);
            $user->setDateFormation($row["formation_year"]);
            $user->setModule($row['module']);
            $user->setPassword($row['password']);
            $user->setFonction("Formateur");
        }

    }else if($_SESSION['type'] == 2)
    {
        $SQLExecuteQuery = mysqli_query($connect, "SELECT matricule, nom, prenom, filiere, formation_year, niveau, groupe_nom, password FROM stagiaires LEFT JOIN groupes on stagiaires.groupe_id = groupes.groupe_id where matricule='$userid'");
        if(mysqli_num_rows($SQLExecuteQuery) > 0)
        {
            $row = mysqli_fetch_assoc($SQLExecuteQuery);
            $user = new Stagiaire();
            $user->setMatricule($userid);
            $user->setNom($row["nom"]);
            $user->setPrenom($row["prenom"]);
            $user->setDateFormation($row["formation_year"]);
            $user->setFiliere($row['filiere']);
            $user->setNiveau($row['niveau']);
            $user->setGroupe($row["groupe_nom"]);
            $user->setPassword($row['password']);
            $user->setFonction("Stagiaire");
        }
        
    }else if($_SESSION['type'] == 3)
    {
        $fonction = "Directeur";
        $SQLExecuteQuery = mysqli_query($connect, "SELECT cin, nom, prenom, fonction, password FROM employés where cin='$userid' AND fonction='$fonction'");
        if(mysqli_num_rows($SQLExecuteQuery) > 0)
        {
            $row = mysqli_fetch_assoc($SQLExecuteQuery);
            $user = new Directeur();
            $user->setCIN($userid);
            $user->setNom($row["nom"]);
            $user->setPrenom($row["prenom"]);
            $user->setFonction($fonction);
            $user->setPassword($row['password']);
        }
    }else if($_SESSION['type'] == 4)
    {
        $fonction = "Conseilleur";
        $SQLExecuteQuery = mysqli_query($connect, "SELECT cin, nom, prenom, fonction, password FROM employés where cin='$userid' AND fonction='$fonction'");
        if(mysqli_num_rows($SQLExecuteQuery) > 0)
        {
            $row = mysqli_fetch_assoc($SQLExecuteQuery);
            $user = new Conseilleur();
            $user->setCIN($userid);
            $user->setNom($row["nom"]);
            $user->setPrenom($row["prenom"]);
            $user->setFonction($fonction);
            $user->setPassword($row['password']);
        }  
    }else{
        @session_destroy();
        header("Location: connexion");
    }
}


?>