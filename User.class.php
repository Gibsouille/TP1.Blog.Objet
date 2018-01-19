<?php

class User {
    private $id_user;
    private $pseudo;
    
    public function __construct($id_user, $pseudo) {
        $this->id_user = $id_user;
        $this->pseudo = $pseudo;
    }
    
    public function __get($property) {
        throw new Exception("Attribut invalide ! Utilisez la méthode get_" . $property . "() s'il elle existe pour accéder à la valeur de l'attribut.");
    }
    
    public function __set($property, $value) {
        throw new Exception("Attribut invalide ! Utilisez la méthode set_" . $property ."(" . $value . ") si elle existe pour modifier l'attribut.");
    }
    
    public function getIdUser() {
        return $this->id_user;
    }
    
    public function getPseudo() {
        return $this->pseudo;
    }
}
