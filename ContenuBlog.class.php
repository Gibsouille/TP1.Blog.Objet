<?php 

class ContenuBlog {
    private $idContenu;
    private $titre;
    private $user;
    private $dateEntree;
    private $commentaire;
    private $cheminPhoto;
    
    public function __construct($id_contenu, $titre, $user, $date_entree, $commentaire, $chemin_photo) {
        $this->idContenu = $id_contenu;
        $this->titre = $titre;
        $this->user = $user;
        $this->dateEntree = $date_entree;
        $this->commentaire = $commentaire;
        $this->cheminPhoto = $chemin_photo;
    }
    
    public function __get($property) {
        throw new Exception("Attribut invalide ! Utilisez la méthode get_" . $property . "() s'il elle existe pour accéder à la valeur de l'attribut.");
    }
    
    public function __set($property, $value) {
        throw new Exception("Attribut invalide ! Utilisez la méthode set_" . $property ."(" . $value . ") si elle existe pour modifier l'attribut.");
    }
    
    public function getTitre() {
        return $this->titre;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function getDateEntree() {
        return $this->dateEntree;
    }
    
    public function getCommentaire() {
        return $this->commentaire;
    }
    
    public function getCheminPhoto() {
        return $this->cheminPhoto;
    }
}
