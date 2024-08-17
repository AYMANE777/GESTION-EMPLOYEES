<?php

class Formateur{
    public $matricule;
    public $nom;
    public $prenom;
    public $dateFormation;
    public $groupe;
    public $module;
    public $password;
    public $fonction;


    function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function setDateFormation($dateFormation)
    {
        $this->dateFormation = $dateFormation;
    }

    function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    }

    function setModule($module)
    {
        $this->module = $module;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }
    
    function setFonction($fonction)
    {
        $this->fonction = $fonction;
    }

    function getFonction()
    {
        return $this->fonction;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getMatricule()
    {
        return $this->matricule;
    }

    function getNom()
    {
        return $this->nom;
    }
    
    function getPrenom()
    {
        return $this->prenom;
    }

    function getGroupe()
    {
        return $this->groupe;
    }

    function getModule()
    {
        return $this->module;
    }

    function getDateFormation()
    {
        return $this->dateFormation;
    }
}
?>