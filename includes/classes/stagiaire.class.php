<?php

class Stagiaire{
    public $matricule;
    public $nom;
    public $prenom;
    public $dateFormation;
    public $groupe;
    public $niveau;
    public $filiere;
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

    function setFiliere($filiere)
    {
        $this->filiere = $filiere;
    }

    function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    }

    function setNiveau($niveau)
    {
        $this->niveau = $niveau;
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

    function getNiveau()
    {
        return $this->niveau;
    }

    function getFiliere()
    {
        return $this->filiere;
    }
    
    function getDateFormation()
    {
        return $this->dateFormation;
    }

}
?>