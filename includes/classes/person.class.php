<?php

class Person{
    public $cin;
    public $nom;
    public $prenom;
    public $fonction;
    
    function setCIN($cin)
    {
        $this->cin = $cin;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    
    function setFonction($fonction)
    {
       $this->fonction = $fonction; 
    }

    function getNom()
    {
        return $this->nom;
    }
    
    function getPrenom()
    {
        return $this->prenom;
    }

    function getCIN()
    {
        return $this->cin;
    }

    function getFonction()
    {
        return $this->fonction;
    }

}
?>