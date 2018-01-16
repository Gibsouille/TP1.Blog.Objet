<?php
include ("./ContenuBlog.php");

class Manager {
    private $connexionDB;
    
    public function __construct($connexionDB) {
        $this->connexionDB = $connexionDB;
    }
    
    public function __get($property) {
        throw new Exception("Attribut invalide ! Utilisez la méthode get_" . $property . "() s'il elle existe pour accéder à la valeur de l'attribut.");
    }
    
    public function __set($property, $value) {
        throw new Exception("Attribut invalide ! Utilisez la méthode set_" . $property ."(" . $value . ") si elle existe pour modifier l'attribut.");
    }
    
    public function ajouterContenuBlog($contenu) {
        try {
            $insertContenu = $this->connexionDB->prepare("INSERT INTO contenu(titre, commentaire, chemin_photo) values(:titre, :commentaire, :chemin_photo)");
            $insertContenu->execute(array(
                'titre' => $contenu->getTitre(),
                'commentaire' => $contenu->getCommentaire(),
                'chemin_photo' => $contenu->getCheminPhoto()
            ));
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
    }
    
    /*public function lireNombreTotalDeContenus() {
        $selectNombreDeContenus = "select count(*) as COMPTEUR from contenu";
        $reponse = $this->connexionDB->query($selectNombreDeContenus);
        
        $nombreDeContenus = $reponse->fetch()['COMPTEUR'];
        $reponse->closeCursor();
        
        return $nombreDeContenus;
    }*/
    
    public function lireTousLesContenus() {
        $contenus = array();
        
        try {
            $selectContenus = "select * from contenu order by date_entree asc";
            $reponse = $this->connexionDB->query($selectContenus);

            while (($ligneReponse = $reponse->fetch())) {
                $contenuBlog = new ContenuBlog($ligneReponse['ID_CONTENU'], $ligneReponse['TITRE'], $ligneReponse['DATE_ENTREE'], $ligneReponse['COMMENTAIRE'], $ligneReponse['CHEMIN_PHOTO']);
                array_push($contenus, $contenuBlog);
            }

            $reponse->closeCursor();
        }
        catch (PDOException $ex) {
            echo 'Erreur : ' . $ex.getMessage() . '\n';
        }
        
        return $contenus;
    }
}
